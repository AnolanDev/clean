<?php

namespace Clean\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Clean\Core\Services\CleanProductService;
use Clean\Core\Models\CleanProduct;
use Clean\Core\Models\CleanBrand;
use Clean\Core\Models\CleanCategory;
use Clean\Core\Models\CleanIngredient;
use Clean\Admin\Traits\HasFilters;
use Clean\Admin\Support\FilterConfig;

class ProductController extends Controller
{
    use HasFilters;
    public function __construct(
        protected CleanProductService $productService
    ) {}

    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'brand_id', 'category_id', 'safety_level', 'search',
            'eco_friendly', 'antibacterial', 'antiviral', 'biodegradable',
            'food_contact_safe', 'no_residue', 'fabric_safe',
            'product_type', 'sort_by', 'sort_order'
        ]);

        // Configuración de filtros para productos
        $filterConfig = array_merge(
            FilterConfig::products(), 
            FilterConfig::defaultSorting()
        );

        // Construir query con el nuevo sistema de filtros
        $query = CleanProduct::with(['brand', 'category']);
        
        // Aplicar filtros usando el trait
        $query = $this->applyFilters($query, $filters, $filterConfig);
        
        // Aplicar ordenamiento
        $query = $this->applySorting($query, $filters, $filterConfig);

        // Paginación con filtros
        $products = $this->paginateWithFilters($query, 20);

        // Datos para filtros
        $brands = CleanBrand::orderBy('name')->get();
        $categories = CleanCategory::orderBy('name')->get();

        // Estadísticas
        $totalProducts = CleanProduct::count();
        $ecoFriendlyCount = CleanProduct::where('is_eco_friendly', true)->count();
        $antibacterialCount = CleanProduct::where('is_antibacterial', true)->count();
        $brandsCount = CleanBrand::count();

        return view('clean-admin::products.index', compact(
            'products', 'brands', 'categories', 'filters',
            'totalProducts', 'ecoFriendlyCount', 'antibacterialCount', 'brandsCount'
        ));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $brands = CleanBrand::orderBy('name')->get();
        $categories = CleanCategory::orderBy('name')->get();
        $ingredients = CleanIngredient::orderBy('name')->get();

        return view('clean-admin::products.create', compact(
            'brands', 'categories', 'ingredients'
        ));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        try {
            DB::beginTransaction();

            // Procesar presentaciones y otros arrays
            $validated['presentations'] = $this->processArrayField($request->input('presentations'));
            $validated['available_fragrances'] = $this->processArrayField($request->input('available_fragrances'));
            $validated['usage_types'] = $this->processArrayField($request->input('usage_types'));
            $validated['compatible_surfaces'] = $this->processArrayField($request->input('compatible_surfaces'));
            $validated['certifications'] = $this->processArrayField($request->input('certifications'));

            // Crear producto
            $product = CleanProduct::create($validated);

            // Asociar ingredientes si se proporcionaron
            if ($request->has('ingredients')) {
                $this->attachIngredients($product, $request->input('ingredients', []));
            }

            // Procesar imágenes si se subieron
            if ($request->hasFile('images')) {
                $this->handleProductImages($product, $request->file('images'));
            }

            DB::commit();

            return redirect()
                ->route('clean.admin.products.show', $product)
                ->with('success', 'Producto creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al crear producto: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear el producto: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified product.
     */
    public function show(CleanProduct $cleanProduct)
    {
        $cleanProduct->load(['brand', 'category', 'ingredients']);

        return view('clean-admin::products.show', ['product' => $cleanProduct]);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(CleanProduct $cleanProduct)
    {
        $cleanProduct->load(['brand', 'category', 'ingredients']);
        
        $brands = CleanBrand::orderBy('name')->get();
        $categories = CleanCategory::orderBy('name')->get();
        $ingredients = CleanIngredient::orderBy('name')->get();

        return view('clean-admin::products.edit', [
            'product' => $cleanProduct,
            'brands' => $brands,
            'categories' => $categories,
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, CleanProduct $cleanProduct)
    {
        $validated = $this->validateProduct($request, $cleanProduct);

        try {
            DB::beginTransaction();

            // Procesar arrays
            $validated['presentations'] = $this->processArrayField($request->input('presentations'));
            $validated['available_fragrances'] = $this->processArrayField($request->input('available_fragrances'));
            $validated['usage_types'] = $this->processArrayField($request->input('usage_types'));
            $validated['compatible_surfaces'] = $this->processArrayField($request->input('compatible_surfaces'));
            $validated['certifications'] = $this->processArrayField($request->input('certifications'));

            // Actualizar producto
            $cleanProduct->update($validated);

            // Actualizar ingredientes
            if ($request->has('ingredients')) {
                $this->attachIngredients($cleanProduct, $request->input('ingredients', []), true);
            }

            // Procesar nuevas imágenes
            if ($request->hasFile('images')) {
                $this->handleProductImages($cleanProduct, $request->file('images'));
            }

            DB::commit();

            return redirect()
                ->route('admin.clean.products.show', $cleanProduct)
                ->with('success', 'Producto actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al actualizar producto: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar el producto: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(CleanProduct $cleanProduct)
    {
        try {
            DB::beginTransaction();

            // Eliminar imágenes asociadas
            $this->deleteProductImages($cleanProduct);

            // Desasociar ingredientes
            $cleanProduct->ingredients()->detach();

            // Eliminar producto
            $cleanProduct->delete();

            DB::commit();

            return redirect()
                ->route('admin.clean.products.index')
                ->with('success', 'Producto eliminado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Error al eliminar producto: ' . $e->getMessage());
            
            return back()
                ->withErrors(['error' => 'Error al eliminar el producto: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk operations on products.
     */
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:delete,update_safety,toggle_eco,export',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:clean_products,id',
            'data' => 'nullable|array'
        ]);

        try {
            $count = 0;
            $productIds = $validated['product_ids'];

            switch ($validated['action']) {
                case 'delete':
                    $count = $this->bulkDelete($productIds);
                    break;
                    
                case 'update_safety':
                    $safetyLevel = $validated['data']['safety_level'] ?? 'non_hazardous';
                    $count = $this->bulkUpdateSafety($productIds, $safetyLevel);
                    break;
                    
                case 'toggle_eco':
                    $count = $this->bulkToggleEco($productIds);
                    break;
                    
                case 'export':
                    return $this->bulkExport($productIds);
            }

            return response()->json([
                'success' => true,
                'message' => "Operación completada en {$count} productos.",
                'count' => $count
            ]);

        } catch (\Exception $e) {
            logger()->error('Error en operación masiva: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error en la operación: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export products to CSV/Excel.
     */
    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $filters = $request->only([
            'brand_id', 'category_id', 'safety_level', 'search',
            'eco_friendly', 'antibacterial'
        ]);

        return $this->productService->exportProducts($filters, $format);
    }

    /**
     * Get product suggestions for autocomplete.
     */
    public function suggestions(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $products = CleanProduct::where('name', 'like', "%{$query}%")
            ->with(['brand', 'category'])
            ->limit(10)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'brand' => $product->brand?->name,
                    'category' => $product->category?->name,
                    'safety' => $product->safety_classification
                ];
            });

        return response()->json($products);
    }

    /**
     * Validate product data.
     */
    private function validateProduct(Request $request, ?CleanProduct $product = null): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'clean_brand_id' => 'required|exists:clean_brands,id',
            'clean_category_id' => 'required|exists:clean_categories,id',
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'product_type' => 'required|in:liquid,powder,gel,spray,foam,paste,crystal',
            'ph_level' => 'nullable|in:acidic,neutral,alkaline',
            'ph_value' => 'nullable|numeric|min:0|max:14',
            'dilution_ratio' => 'nullable|string|max:100',
            'coverage_area' => 'nullable|integer|min:1',
            'contact_time' => 'nullable|string|max:100',
            'safety_classification' => 'required|in:non_hazardous,irritant,corrosive,toxic,flammable',
            'usage_instructions' => 'nullable|string',
            'precautions' => 'nullable|string',
            'first_aid' => 'nullable|string',
            'storage_conditions' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'fragrance' => 'nullable|string|max:100',
            'density' => 'nullable|numeric|min:0',
            'shelf_life_months' => 'nullable|integer|min:1|max:120',
            'packaging_material' => 'nullable|string|max:100',
            'concentration_percentage' => 'nullable|string|max:20',
            'yield_information' => 'nullable|string',
            // Campos booleanos
            'is_concentrated' => 'boolean',
            'is_antibacterial' => 'boolean',
            'is_antiviral' => 'boolean',
            'is_antifungal' => 'boolean',
            'is_eco_friendly' => 'boolean',
            'is_biodegradable' => 'boolean',
            'is_phosphate_free' => 'boolean',
            'is_chlorine_free' => 'boolean',
            'is_ammonia_free' => 'boolean',
            'is_fragrance_free' => 'boolean',
            'food_contact_safe' => 'boolean',
            'no_residue' => 'boolean',
            'fabric_safe' => 'boolean',
            'is_concentrated_formula' => 'boolean',
            // Arrays (serán procesados separadamente)
            'presentations' => 'nullable|string',
            'available_fragrances' => 'nullable|string',
            'usage_types' => 'nullable|string',
            'compatible_surfaces' => 'nullable|string',
            'certifications' => 'nullable|string',
            // Ingredientes
            'ingredients' => 'nullable|array',
            'ingredients.*.id' => 'exists:clean_ingredients,id',
            'ingredients.*.concentration' => 'nullable|numeric|min:0|max:100',
            'ingredients.*.is_active' => 'boolean',
            'ingredients.*.function' => 'nullable|string|max:255',
            // Imágenes
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Si es actualización, hacer el nombre único excluyendo el producto actual
        if ($product) {
            $rules['name'] = 'required|string|max:255|unique:clean_products,name,' . $product->id;
        } else {
            $rules['name'] .= '|unique:clean_products,name';
        }

        return $request->validate($rules);
    }

    /**
     * Process array field from string.
     */
    private function processArrayField(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_filter(
            array_map('trim', explode(',', $value)),
            fn($item) => !empty($item)
        );
    }

    /**
     * Attach ingredients to product.
     */
    private function attachIngredients(CleanProduct $product, array $ingredients, bool $sync = false): void
    {
        $ingredientData = [];

        foreach ($ingredients as $ingredient) {
            if (empty($ingredient['id'])) continue;

            $ingredientData[$ingredient['id']] = [
                'concentration' => $ingredient['concentration'] ?? null,
                'is_active_ingredient' => $ingredient['is_active'] ?? false,
                'function_in_product' => $ingredient['function'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        if ($sync) {
            $product->ingredients()->sync($ingredientData);
        } else {
            $product->ingredients()->attach($ingredientData);
        }
    }

    /**
     * Handle product images upload.
     */
    private function handleProductImages(CleanProduct $product, array $images): void
    {
        $uploadedImages = [];

        foreach ($images as $index => $image) {
            $filename = $product->id . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('products/' . $product->id, $filename, 'public');
            
            $uploadedImages[] = [
                'filename' => $filename,
                'path' => $path,
                'size' => $image->getSize(),
                'mime_type' => $image->getMimeType()
            ];
        }

        // Guardar información de imágenes en el producto (podrías tener una tabla separada)
        $currentImages = $product->images ?? [];
        $product->update(['images' => array_merge($currentImages, $uploadedImages)]);
    }

    /**
     * Delete product images.
     */
    private function deleteProductImages(CleanProduct $product): void
    {
        if (!empty($product->images)) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image['path'] ?? '');
            }
        }

        // También eliminar directorio del producto si existe
        Storage::disk('public')->deleteDirectory('products/' . $product->id);
    }

    /**
     * Bulk delete products.
     */
    private function bulkDelete(array $productIds): int
    {
        return DB::transaction(function () use ($productIds) {
            $products = CleanProduct::whereIn('id', $productIds)->get();
            
            foreach ($products as $product) {
                $this->deleteProductImages($product);
                $product->ingredients()->detach();
            }

            return CleanProduct::whereIn('id', $productIds)->delete();
        });
    }

    /**
     * Bulk update safety classification.
     */
    private function bulkUpdateSafety(array $productIds, string $safetyLevel): int
    {
        return CleanProduct::whereIn('id', $productIds)
            ->update(['safety_classification' => $safetyLevel]);
    }

    /**
     * Bulk toggle eco-friendly status.
     */
    private function bulkToggleEco(array $productIds): int
    {
        return DB::transaction(function () use ($productIds) {
            $count = 0;
            $products = CleanProduct::whereIn('id', $productIds)->get();
            
            foreach ($products as $product) {
                $product->update(['is_eco_friendly' => !$product->is_eco_friendly]);
                $count++;
            }
            
            return $count;
        });
    }

    /**
     * Bulk export products.
     */
    private function bulkExport(array $productIds)
    {
        $products = CleanProduct::with(['brand', 'category'])
            ->whereIn('id', $productIds)
            ->get();

        // Implementar exportación CSV
        return $this->productService->exportProductsCollection($products, 'csv');
    }
}