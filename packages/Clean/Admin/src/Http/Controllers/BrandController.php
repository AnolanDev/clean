<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Clean\Core\Models\CleanBrand;

class BrandController extends Controller
{
    /**
     * Display a listing of brands.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'search', 'country', 'eco_friendly', 'status', 'sort_by', 'sort_order'
        ]);

        // Construir query con filtros
        $query = CleanBrand::withCount('products')
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where(function($subQ) use ($search) {
                    $subQ->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%")
                         ->orWhere('country', 'like', "%{$search}%");
                }))
            ->when($filters['country'] ?? null, fn($q, $country) => 
                $q->where('country', $country))
            ->when(isset($filters['eco_friendly']), fn($q) => 
                $q->where('is_eco_friendly', true))
            ->when(isset($filters['status']), fn($q) => 
                $q->where('status', $filters['status']));

        // Ordenamiento
        $sortBy = $filters['sort_by'] ?? 'sort_order';
        $sortOrder = $filters['sort_order'] ?? 'asc';
        $query->orderBy($sortBy, $sortOrder)->orderBy('name');

        $brands = $query->paginate(20)->withQueryString();

        // Estadísticas
        $totalBrands = CleanBrand::count();
        $activeBrands = CleanBrand::where('status', true)->count();
        $ecoFriendlyBrands = CleanBrand::where('is_eco_friendly', true)->count();
        $countriesCount = CleanBrand::distinct('country')->whereNotNull('country')->count();

        // Lista de países únicos para filtros
        $countries = CleanBrand::select('country')
            ->whereNotNull('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        return view('clean-admin::brands.index', compact(
            'brands', 'countries', 'filters',
            'totalBrands', 'activeBrands', 'ecoFriendlyBrands', 'countriesCount'
        ));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        return view('clean-admin::brands.create');
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateBrand($request);

        try {
            DB::beginTransaction();

            // Generar slug automático si no se proporciona
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            // Asegurar slug único
            $validated['slug'] = $this->ensureUniqueSlug($validated['slug']);

            // Procesar certificaciones
            $validated['certifications'] = $this->processCertifications($request->input('certifications'));

            // Crear marca
            $brand = CleanBrand::create($validated);

            // Procesar logo si se subió
            if ($request->hasFile('logo')) {
                $this->handleBrandLogo($brand, $request->file('logo'));
            }

            DB::commit();

            return redirect()
                ->route('admin.clean.brands.show', $brand)
                ->with('success', 'Marca creada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al crear marca: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la marca: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified brand.
     */
    public function show(CleanBrand $cleanBrand)
    {
        $cleanBrand->loadCount('products');
        
        // Obtener productos recientes de la marca
        $recentProducts = $cleanBrand->products()
            ->latest()
            ->limit(5)
            ->get();

        return view('clean-admin::brands.show', [
            'brand' => $cleanBrand,
            'recentProducts' => $recentProducts
        ]);
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(CleanBrand $cleanBrand)
    {
        return view('clean-admin::brands.edit', [
            'brand' => $cleanBrand
        ]);
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, CleanBrand $cleanBrand)
    {
        $validated = $this->validateBrand($request, $cleanBrand);

        try {
            DB::beginTransaction();

            // Generar slug si se cambió el nombre
            if ($validated['name'] !== $cleanBrand->name && empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
                $validated['slug'] = $this->ensureUniqueSlug($validated['slug'], $cleanBrand->id);
            }

            // Procesar certificaciones
            $validated['certifications'] = $this->processCertifications($request->input('certifications'));

            // Actualizar marca
            $cleanBrand->update($validated);

            // Procesar nuevo logo
            if ($request->hasFile('logo')) {
                $this->handleBrandLogo($cleanBrand, $request->file('logo'));
            }

            DB::commit();

            return redirect()
                ->route('admin.clean.brands.show', $cleanBrand)
                ->with('success', 'Marca actualizada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al actualizar marca: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la marca: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy(CleanBrand $cleanBrand)
    {
        try {
            DB::beginTransaction();

            // Verificar si tiene productos asociados
            if ($cleanBrand->products()->count() > 0) {
                return back()->withErrors([
                    'error' => 'No se puede eliminar la marca porque tiene productos asociados.'
                ]);
            }

            // Eliminar logo si existe
            $this->deleteBrandLogo($cleanBrand);

            // Eliminar marca
            $cleanBrand->delete();

            DB::commit();

            return redirect()
                ->route('admin.clean.brands.index')
                ->with('success', 'Marca eliminada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al eliminar marca: ' . $e->getMessage());
            
            return back()
                ->withErrors(['error' => 'Error al eliminar la marca: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk operations on brands.
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,activate,deactivate,toggle_eco,export',
            'brand_ids' => 'required|array|min:1',
            'brand_ids.*' => 'exists:clean_brands,id'
        ]);

        try {
            $count = 0;
            $brandIds = $validated['brand_ids'];

            switch ($validated['action']) {
                case 'delete':
                    $count = $this->bulkDelete($brandIds);
                    break;
                    
                case 'activate':
                    $count = $this->bulkUpdateStatus($brandIds, true);
                    break;
                    
                case 'deactivate':
                    $count = $this->bulkUpdateStatus($brandIds, false);
                    break;
                    
                case 'toggle_eco':
                    $count = $this->bulkToggleEco($brandIds);
                    break;
                    
                case 'export':
                    return $this->bulkExport($brandIds);
            }

            return response()->json([
                'success' => true,
                'message' => "Operación completada en {$count} marcas.",
                'count' => $count
            ]);

        } catch (\Exception $e) {
            logger()->error('Error en operación masiva de marcas: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error en la operación: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export brands to CSV/Excel.
     */
    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $filters = $request->only(['search', 'country', 'eco_friendly', 'status']);

        $brands = CleanBrand::withCount('products')
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%"))
            ->when($filters['country'] ?? null, fn($q, $country) => 
                $q->where('country', $country))
            ->when(isset($filters['eco_friendly']), fn($q) => 
                $q->where('is_eco_friendly', true))
            ->when(isset($filters['status']), fn($q) => 
                $q->where('status', $filters['status']))
            ->orderBy('name')
            ->get();

        return $this->generateExport($brands, $format);
    }

    /**
     * Validate brand data.
     */
    private function validateBrand(Request $request, ?CleanBrand $brand = null): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|alpha_dash',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'country' => 'nullable|string|max:100',
            'is_eco_friendly' => 'boolean',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'certifications' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        // Validar unicidad del nombre y slug
        if ($brand) {
            $rules['name'] .= '|unique:clean_brands,name,' . $brand->id;
            if ($request->input('slug')) {
                $rules['slug'] .= '|unique:clean_brands,slug,' . $brand->id;
            }
        } else {
            $rules['name'] .= '|unique:clean_brands,name';
            if ($request->input('slug')) {
                $rules['slug'] .= '|unique:clean_brands,slug';
            }
        }

        return $request->validate($rules);
    }

    /**
     * Process certifications from string to array.
     */
    private function processCertifications(?string $certifications): array
    {
        if (empty($certifications)) {
            return [];
        }

        return array_filter(
            array_map('trim', explode(',', $certifications)),
            fn($item) => !empty($item)
        );
    }

    /**
     * Ensure unique slug.
     */
    private function ensureUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $originalSlug = $slug;
        $counter = 1;

        while (CleanBrand::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Handle brand logo upload.
     */
    private function handleBrandLogo(CleanBrand $brand, $logoFile): void
    {
        // Eliminar logo anterior si existe
        $this->deleteBrandLogo($brand);

        $filename = $brand->slug . '_logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
        $path = $logoFile->storeAs('brands/logos', $filename, 'public');
        
        $brand->update(['logo' => $path]);
    }

    /**
     * Delete brand logo.
     */
    private function deleteBrandLogo(CleanBrand $brand): void
    {
        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }
    }

    /**
     * Bulk delete brands.
     */
    private function bulkDelete(array $brandIds): int
    {
        return DB::transaction(function () use ($brandIds) {
            $brands = CleanBrand::whereIn('id', $brandIds)
                ->whereDoesntHave('products')
                ->get();
            
            foreach ($brands as $brand) {
                $this->deleteBrandLogo($brand);
            }

            return CleanBrand::whereIn('id', $brands->pluck('id'))->delete();
        });
    }

    /**
     * Bulk update status.
     */
    private function bulkUpdateStatus(array $brandIds, bool $status): int
    {
        return CleanBrand::whereIn('id', $brandIds)
            ->update(['status' => $status]);
    }

    /**
     * Bulk toggle eco-friendly status.
     */
    private function bulkToggleEco(array $brandIds): int
    {
        return DB::transaction(function () use ($brandIds) {
            $count = 0;
            $brands = CleanBrand::whereIn('id', $brandIds)->get();
            
            foreach ($brands as $brand) {
                $brand->update(['is_eco_friendly' => !$brand->is_eco_friendly]);
                $count++;
            }
            
            return $count;
        });
    }

    /**
     * Generate export file.
     */
    private function generateExport($brands, string $format)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="marcas_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($brands) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Nombre', 'Slug', 'País', 'Productos', 'Ecológica', 
                'Estado', 'Sitio Web', 'Certificaciones', 'Creado'
            ]);

            // Data
            foreach ($brands as $brand) {
                fputcsv($file, [
                    $brand->id,
                    $brand->name,
                    $brand->slug,
                    $brand->country ?? 'N/A',
                    $brand->products_count ?? 0,
                    $brand->is_eco_friendly ? 'Sí' : 'No',
                    $brand->status ? 'Activa' : 'Inactiva',
                    $brand->website ?? 'N/A',
                    implode(', ', $brand->certifications ?? []),
                    $brand->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Bulk export brands.
     */
    private function bulkExport(array $brandIds)
    {
        $brands = CleanBrand::withCount('products')
            ->whereIn('id', $brandIds)
            ->orderBy('name')
            ->get();

        return $this->generateExport($brands, 'csv');
    }
}