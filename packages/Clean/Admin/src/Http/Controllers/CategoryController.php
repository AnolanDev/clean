<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Clean\Core\Models\CleanCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'search', 'usage_area', 'surface_type', 'parent_id', 'status', 'professional_use', 'sort_by', 'sort_order'
        ]);

        // Construir query con filtros
        $query = CleanCategory::withCount(['products', 'children'])
            ->with('parent')
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where(function($subQ) use ($search) {
                    $subQ->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%")
                         ->orWhere('usage_area', 'like', "%{$search}%")
                         ->orWhere('surface_type', 'like', "%{$search}%");
                }))
            ->when($filters['usage_area'] ?? null, fn($q, $area) => 
                $q->where('usage_area', $area))
            ->when($filters['surface_type'] ?? null, fn($q, $type) => 
                $q->where('surface_type', $type))
            ->when(isset($filters['parent_id']), function($q) use ($filters) {
                if ($filters['parent_id'] === 'root') {
                    return $q->whereNull('parent_id');
                }
                return $q->where('parent_id', $filters['parent_id']);
            })
            ->when(isset($filters['status']), fn($q) => 
                $q->where('status', $filters['status']))
            ->when(isset($filters['professional_use']), fn($q) => 
                $q->where('professional_use', true));

        // Ordenamiento
        $sortBy = $filters['sort_by'] ?? 'sort_order';
        $sortOrder = $filters['sort_order'] ?? 'asc';
        $query->orderBy($sortBy, $sortOrder)->orderBy('name');

        $categories = $query->paginate(20)->withQueryString();

        // Estadísticas
        $totalCategories = CleanCategory::count();
        $activeCategories = CleanCategory::where('status', true)->count();
        $rootCategories = CleanCategory::whereNull('parent_id')->count();
        $professionalCategories = CleanCategory::where('professional_use', true)->count();

        // Listas para filtros
        $usageAreas = CleanCategory::select('usage_area')
            ->whereNotNull('usage_area')
            ->distinct()
            ->orderBy('usage_area')
            ->pluck('usage_area');

        $surfaceTypes = CleanCategory::select('surface_type')
            ->whereNotNull('surface_type')
            ->distinct()
            ->orderBy('surface_type')
            ->pluck('surface_type');

        $parentCategories = CleanCategory::whereNull('parent_id')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('clean-admin::categories.index', compact(
            'categories', 'usageAreas', 'surfaceTypes', 'parentCategories', 'filters',
            'totalCategories', 'activeCategories', 'rootCategories', 'professionalCategories'
        ));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $parentCategories = CleanCategory::whereNull('parent_id')
            ->active()
            ->ordered()
            ->get(['id', 'name']);

        $usageAreas = ['Cocina', 'Baño', 'Pisos', 'Vidrios', 'Muebles', 'Exterior', 'Lavandería', 'General'];
        $surfaceTypes = ['Cerámica', 'Vidrio', 'Madera', 'Metal', 'Plástico', 'Tela', 'Piedra', 'Mixto'];

        return view('clean-admin::categories.create', compact(
            'parentCategories', 'usageAreas', 'surfaceTypes'
        ));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateCategory($request);

        try {
            DB::beginTransaction();

            // Generar slug automático si no se proporciona
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            // Asegurar slug único
            $validated['slug'] = $this->ensureUniqueSlug($validated['slug']);

            // Procesar metadata
            $validated['metadata'] = $this->processMetadata($request);

            // Crear categoría
            $category = CleanCategory::create($validated);

            // Procesar imagen si se subió
            if ($request->hasFile('image')) {
                $this->handleCategoryImage($category, $request->file('image'));
            }

            DB::commit();

            return redirect()
                ->route('admin.clean.categories.show', $category)
                ->with('success', 'Categoría creada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al crear categoría: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la categoría: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified category.
     */
    public function show(CleanCategory $cleanCategory)
    {
        $cleanCategory->loadCount(['products', 'children']);
        $cleanCategory->load(['parent', 'children.children']);
        
        // Obtener productos recientes de la categoría
        $recentProducts = $cleanCategory->products()
            ->with('brand')
            ->latest()
            ->limit(10)
            ->get();

        // Obtener categorías relacionadas (hermanas)
        $siblingCategories = CleanCategory::where('parent_id', $cleanCategory->parent_id)
            ->where('id', '!=', $cleanCategory->id)
            ->active()
            ->ordered()
            ->limit(5)
            ->get();

        return view('clean-admin::categories.show', [
            'category' => $cleanCategory,
            'recentProducts' => $recentProducts,
            'siblingCategories' => $siblingCategories
        ]);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(CleanCategory $cleanCategory)
    {
        $parentCategories = CleanCategory::whereNull('parent_id')
            ->where('id', '!=', $cleanCategory->id)
            ->active()
            ->ordered()
            ->get(['id', 'name']);

        $usageAreas = ['Cocina', 'Baño', 'Pisos', 'Vidrios', 'Muebles', 'Exterior', 'Lavandería', 'General'];
        $surfaceTypes = ['Cerámica', 'Vidrio', 'Madera', 'Metal', 'Plástico', 'Tela', 'Piedra', 'Mixto'];

        return view('clean-admin::categories.edit', [
            'category' => $cleanCategory,
            'parentCategories' => $parentCategories,
            'usageAreas' => $usageAreas,
            'surfaceTypes' => $surfaceTypes
        ]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, CleanCategory $cleanCategory)
    {
        $validated = $this->validateCategory($request, $cleanCategory);

        try {
            DB::beginTransaction();

            // Verificar que no se esté asignando como padre de sí mismo o de sus descendientes
            if (isset($validated['parent_id']) && $validated['parent_id']) {
                if ($this->wouldCreateCycle($cleanCategory->id, $validated['parent_id'])) {
                    return back()
                        ->withInput()
                        ->withErrors(['parent_id' => 'No se puede asignar esta categoría como padre porque crearía un ciclo.']);
                }
            }

            // Generar slug si se cambió el nombre
            if ($validated['name'] !== $cleanCategory->name && empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
                $validated['slug'] = $this->ensureUniqueSlug($validated['slug'], $cleanCategory->id);
            }

            // Procesar metadata
            $validated['metadata'] = $this->processMetadata($request);

            // Actualizar categoría
            $cleanCategory->update($validated);

            // Procesar nueva imagen
            if ($request->hasFile('image')) {
                $this->handleCategoryImage($cleanCategory, $request->file('image'));
            }

            DB::commit();

            return redirect()
                ->route('admin.clean.categories.show', $cleanCategory)
                ->with('success', 'Categoría actualizada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al actualizar categoría: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar la categoría: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(CleanCategory $cleanCategory)
    {
        try {
            DB::beginTransaction();

            // Verificar si tiene productos asociados
            if ($cleanCategory->products()->count() > 0) {
                return back()->withErrors([
                    'error' => 'No se puede eliminar la categoría porque tiene productos asociados.'
                ]);
            }

            // Verificar si tiene subcategorías
            if ($cleanCategory->children()->count() > 0) {
                return back()->withErrors([
                    'error' => 'No se puede eliminar la categoría porque tiene subcategorías asociadas.'
                ]);
            }

            // Eliminar imagen si existe
            $this->deleteCategoryImage($cleanCategory);

            // Eliminar categoría
            $cleanCategory->delete();

            DB::commit();

            return redirect()
                ->route('admin.clean.categories.index')
                ->with('success', 'Categoría eliminada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al eliminar categoría: ' . $e->getMessage());
            
            return back()
                ->withErrors(['error' => 'Error al eliminar la categoría: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk operations on categories.
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,activate,deactivate,toggle_professional,export',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:clean_categories,id'
        ]);

        try {
            $count = 0;
            $categoryIds = $validated['category_ids'];

            switch ($validated['action']) {
                case 'delete':
                    $count = $this->bulkDelete($categoryIds);
                    break;
                    
                case 'activate':
                    $count = $this->bulkUpdateStatus($categoryIds, true);
                    break;
                    
                case 'deactivate':
                    $count = $this->bulkUpdateStatus($categoryIds, false);
                    break;
                    
                case 'toggle_professional':
                    $count = $this->bulkToggleProfessional($categoryIds);
                    break;
                    
                case 'export':
                    return $this->bulkExport($categoryIds);
            }

            return response()->json([
                'success' => true,
                'message' => "Operación completada en {$count} categorías.",
                'count' => $count
            ]);

        } catch (\Exception $e) {
            logger()->error('Error en operación masiva de categorías: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error en la operación: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export categories to CSV/Excel.
     */
    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $filters = $request->only(['search', 'usage_area', 'surface_type', 'parent_id', 'status']);

        $categories = CleanCategory::withCount(['products', 'children'])
            ->with('parent')
            ->when($filters['search'] ?? null, fn($q, $search) => 
                $q->where('name', 'like', "%{$search}%"))
            ->when($filters['usage_area'] ?? null, fn($q, $area) => 
                $q->where('usage_area', $area))
            ->when($filters['surface_type'] ?? null, fn($q, $type) => 
                $q->where('surface_type', $type))
            ->when(isset($filters['parent_id']), function($q) use ($filters) {
                if ($filters['parent_id'] === 'root') {
                    return $q->whereNull('parent_id');
                }
                return $q->where('parent_id', $filters['parent_id']);
            })
            ->when(isset($filters['status']), fn($q) => 
                $q->where('status', $filters['status']))
            ->ordered()
            ->get();

        return $this->generateExport($categories, $format);
    }

    /**
     * Validate category data.
     */
    private function validateCategory(Request $request, ?CleanCategory $category = null): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|alpha_dash',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:clean_categories,id',
            'usage_area' => 'nullable|string|max:100',
            'surface_type' => 'nullable|string|max:100',
            'status' => 'boolean',
            'requires_dilution' => 'boolean',
            'professional_use' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        // Validar unicidad del nombre y slug
        if ($category) {
            $rules['name'] .= '|unique:clean_categories,name,' . $category->id;
            if ($request->input('slug')) {
                $rules['slug'] .= '|unique:clean_categories,slug,' . $category->id;
            }
        } else {
            $rules['name'] .= '|unique:clean_categories,name';
            if ($request->input('slug')) {
                $rules['slug'] .= '|unique:clean_categories,slug';
            }
        }

        return $request->validate($rules);
    }

    /**
     * Process metadata from request.
     */
    private function processMetadata(Request $request): array
    {
        $metadata = [];
        
        // Agregar campos adicionales como metadata
        if ($request->filled('color')) {
            $metadata['color'] = $request->input('color');
        }
        
        if ($request->filled('tags')) {
            $metadata['tags'] = array_filter(
                array_map('trim', explode(',', $request->input('tags'))),
                fn($tag) => !empty($tag)
            );
        }

        return $metadata;
    }

    /**
     * Ensure unique slug.
     */
    private function ensureUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $originalSlug = $slug;
        $counter = 1;

        while (CleanCategory::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Check if assigning parent would create a cycle.
     */
    private function wouldCreateCycle(int $categoryId, int $parentId): bool
    {
        $category = CleanCategory::find($categoryId);
        if (!$category) return false;

        $descendants = $category->descendants();
        return $descendants->contains('id', $parentId);
    }

    /**
     * Handle category image upload.
     */
    private function handleCategoryImage(CleanCategory $category, $imageFile): void
    {
        // Eliminar imagen anterior si existe
        $this->deleteCategoryImage($category);

        $filename = $category->slug . '_image_' . time() . '.' . $imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs('categories/images', $filename, 'public');
        
        $category->update(['image' => $path]);
    }

    /**
     * Delete category image.
     */
    private function deleteCategoryImage(CleanCategory $category): void
    {
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }
    }

    /**
     * Bulk delete categories.
     */
    private function bulkDelete(array $categoryIds): int
    {
        return DB::transaction(function () use ($categoryIds) {
            $categories = CleanCategory::whereIn('id', $categoryIds)
                ->whereDoesntHave('products')
                ->whereDoesntHave('children')
                ->get();
            
            foreach ($categories as $category) {
                $this->deleteCategoryImage($category);
            }

            return CleanCategory::whereIn('id', $categories->pluck('id'))->delete();
        });
    }

    /**
     * Bulk update status.
     */
    private function bulkUpdateStatus(array $categoryIds, bool $status): int
    {
        return CleanCategory::whereIn('id', $categoryIds)
            ->update(['status' => $status]);
    }

    /**
     * Bulk toggle professional use.
     */
    private function bulkToggleProfessional(array $categoryIds): int
    {
        return DB::transaction(function () use ($categoryIds) {
            $count = 0;
            $categories = CleanCategory::whereIn('id', $categoryIds)->get();
            
            foreach ($categories as $category) {
                $category->update(['professional_use' => !$category->professional_use]);
                $count++;
            }
            
            return $count;
        });
    }

    /**
     * Generate export file.
     */
    private function generateExport($categories, string $format)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="categorias_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($categories) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Nombre', 'Slug', 'Área de Uso', 'Tipo de Superficie', 'Categoría Padre',
                'Productos', 'Subcategorías', 'Profesional', 'Estado', 'Creado'
            ]);

            // Data
            foreach ($categories as $category) {
                fputcsv($file, [
                    $category->id,
                    $category->name,
                    $category->slug,
                    $category->usage_area ?? 'N/A',
                    $category->surface_type ?? 'N/A',
                    $category->parent->name ?? 'Categoría raíz',
                    $category->products_count ?? 0,
                    $category->children_count ?? 0,
                    $category->professional_use ? 'Sí' : 'No',
                    $category->status ? 'Activa' : 'Inactiva',
                    $category->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Bulk export categories.
     */
    private function bulkExport(array $categoryIds)
    {
        $categories = CleanCategory::withCount(['products', 'children'])
            ->with('parent')
            ->whereIn('id', $categoryIds)
            ->ordered()
            ->get();

        return $this->generateExport($categories, 'csv');
    }
}