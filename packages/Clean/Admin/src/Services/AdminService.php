<?php

namespace Clean\Admin\Services;

use Clean\Core\Repositories\CleanProductRepository;
use Clean\Core\Repositories\CleanBrandRepository;
use Clean\Core\Repositories\CleanCategoryRepository;
use Clean\Core\Repositories\CleanIngredientRepository;
use Clean\Core\Services\CleanProductService;
use Clean\Core\Models\CleanSetting;
use Clean\Core\Helpers\CleanConfigHelper;
use Clean\Core\Helpers\CleanProductHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

class AdminService
{
    public function __construct(
        protected CleanProductRepository $productRepository,
        protected CleanBrandRepository $brandRepository,
        protected CleanCategoryRepository $categoryRepository,
        protected CleanIngredientRepository $ingredientRepository,
        protected CleanProductService $productService
    ) {}

    /**
     * Get dashboard statistics.
     */
    public function getDashboardStatistics(): array
    {
        $totalProducts = $this->productRepository->getModel()->count();
        $ecoFriendlyProducts = $this->productRepository->getEcoFriendly()->count();
        $hazardousProducts = $this->productRepository->getBySafetyLevel('hazardous')->count();
        $safeProducts = $this->productRepository->getSafe()->count();
        $totalBrands = $this->brandRepository->getModel()->count();
        $totalCategories = $this->categoryRepository->getModel()->count();
        $totalIngredients = $this->ingredientRepository->getModel()->count();
        $hazardousIngredients = $this->ingredientRepository->getHazardous()->count();

        return [
            'total_products' => $totalProducts,
            'eco_friendly_products' => $ecoFriendlyProducts,
            'hazardous_products' => $hazardousProducts,
            'safe_products' => $safeProducts,
            'total_brands' => $totalBrands,
            'total_categories' => $totalCategories,
            'total_ingredients' => $totalIngredients,
            'hazardous_ingredients' => $hazardousIngredients,
            'eco_percentage' => $totalProducts > 0 ? round(($ecoFriendlyProducts / $totalProducts) * 100, 1) : 0,
            'safety_percentage' => $totalProducts > 0 ? round(($safeProducts / $totalProducts) * 100, 1) : 0,
        ];
    }

    /**
     * Get recent products.
     */
    public function getRecentProducts(int $limit = 10): Collection
    {
        return $this->productRepository->getModel()
            ->with(['brand', 'category'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get top brands by product count.
     */
    public function getTopBrands(int $limit = 5): Collection
    {
        return $this->brandRepository->getPopular($limit);
    }

    /**
     * Get safety alerts.
     */
    public function getSafetyAlerts(): array
    {
        $alerts = [];

        // Check for products with too many hazardous ingredients
        $maxHazardous = CleanConfigHelper::getMaxHazardousIngredients();
        $problematicProducts = $this->productRepository->getModel()
            ->whereHas('ingredients', function ($query) {
                $query->where('safety_level', 'hazardous');
            }, '>', $maxHazardous)
            ->count();

        if ($problematicProducts > 0) {
            $alerts[] = [
                'type' => 'warning',
                'message' => "{$problematicProducts} productos exceden el límite de ingredientes peligrosos",
                'action' => 'Revisar productos'
            ];
        }

        // Check for products without safety classification
        $unclassifiedProducts = $this->productRepository->getModel()
            ->whereNull('safety_classification')
            ->count();

        if ($unclassifiedProducts > 0) {
            $alerts[] = [
                'type' => 'info',
                'message' => "{$unclassifiedProducts} productos sin clasificación de seguridad",
                'action' => 'Clasificar productos'
            ];
        }

        return $alerts;
    }

    /**
     * Get paginated products.
     */
    public function getProductsPaginated(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        return $this->productService->getPaginatedProducts($filters, $perPage);
    }

    /**
     * Get all brands.
     */
    public function getAllBrands(): Collection
    {
        return $this->brandRepository->getActive();
    }

    /**
     * Get all categories.
     */
    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getActive();
    }

    /**
     * Get paginated brands.
     */
    public function getBrandsPaginated(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = $this->brandRepository->getModel()->query();

        if (!empty($filters['search'])) {
            $query->where('name', 'LIKE', '%' . $filters['search'] . '%');
        }

        if (isset($filters['eco_friendly'])) {
            $query->where('is_eco_friendly', $filters['eco_friendly']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get categories tree.
     */
    public function getCategoriesTree(): Collection
    {
        return $this->categoryRepository->getCategoryTree();
    }

    /**
     * Get paginated ingredients.
     */
    public function getIngredientsPaginated(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = $this->ingredientRepository->getModel()->query();

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'LIKE', '%' . $filters['search'] . '%')
                  ->orWhere('chemical_name', 'LIKE', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['safety_level'])) {
            $query->where('safety_level', $filters['safety_level']);
        }

        if (isset($filters['natural'])) {
            $query->where('is_natural', $filters['natural']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get safety reports.
     */
    public function getSafetyReports(): array
    {
        $reports = [];

        // Products by safety level
        $safetyLevels = $this->productRepository->getModel()
            ->selectRaw('safety_classification, COUNT(*) as count')
            ->groupBy('safety_classification')
            ->get()
            ->pluck('count', 'safety_classification')
            ->toArray();

        $reports['safety_levels'] = $safetyLevels;

        // Ingredients by safety level
        $ingredientSafety = $this->ingredientRepository->getModel()
            ->selectRaw('safety_level, COUNT(*) as count')
            ->groupBy('safety_level')
            ->get()
            ->pluck('count', 'safety_level')
            ->toArray();

        $reports['ingredient_safety'] = $ingredientSafety;

        // Top hazardous ingredients
        $hazardousIngredients = $this->ingredientRepository->getModel()
            ->hazardous()
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(10)
            ->get();

        $reports['hazardous_ingredients'] = $hazardousIngredients;

        return $reports;
    }

    /**
     * Get hazardous products.
     */
    public function getHazardousProducts(): Collection
    {
        return $this->productRepository->getModel()
            ->where('safety_classification', 'hazardous')
            ->with(['brand', 'category'])
            ->get();
    }

    /**
     * Get safety statistics.
     */
    public function getSafetyStatistics(): array
    {
        $productStats = $this->productService->getProductStatistics();
        $ingredientStats = $this->ingredientRepository->getStatistics();

        return [
            'products' => $productStats,
            'ingredients' => $ingredientStats
        ];
    }

    /**
     * Get analytics data.
     */
    public function getAnalytics(): array
    {
        // This would typically integrate with analytics services
        // For now, we'll return basic statistics
        return [
            'product_views' => 0,
            'search_queries' => 0,
            'popular_categories' => $this->categoryRepository->getPopular(5),
            'eco_trend' => $this->getEcoTrend(),
        ];
    }

    /**
     * Get product trends.
     */
    public function getProductTrends(): array
    {
        // Mock data for demonstration
        return [
            'eco_products' => [
                'current' => $this->productRepository->getEcoFriendly()->count(),
                'growth' => '+15%'
            ],
            'safe_products' => [
                'current' => $this->productRepository->getSafe()->count(),
                'growth' => '+8%'
            ],
            'new_products' => [
                'current' => $this->productRepository->getModel()
                    ->where('created_at', '>=', now()->subMonth())
                    ->count(),
                'growth' => '+12%'
            ]
        ];
    }

    /**
     * Get brand performance.
     */
    public function getBrandPerformance(): Collection
    {
        return $this->brandRepository->getModel()
            ->orderBy('name', 'asc')
            ->take(10)
            ->get();
    }

    /**
     * Get settings.
     */
    public function getSettings(): array
    {
        return [
            'general' => CleanConfigHelper::getCompanyInfo(),
            'catalog' => CleanConfigHelper::getCatalogSettings(),
            'safety' => CleanConfigHelper::getSafetySettings(),
            'filters' => CleanConfigHelper::getEnabledFilters(),
        ];
    }

    /**
     * Update settings.
     */
    public function updateSettings(array $settings): void
    {
        foreach ($settings as $key => $value) {
            CleanConfigHelper::set($key, $value);
        }
    }

    /**
     * Export products data.
     */
    public function exportProducts(array $filters, string $format = 'csv')
    {
        $products = $this->productService->getFilteredProducts($filters);
        
        $data = $products->map(function ($product) {
            return [
                'ID' => $product->id,
                'Nombre' => $product->product->name ?? 'N/A',
                'Marca' => $product->brand->name ?? 'N/A',
                'Categoría' => $product->category->name ?? 'N/A',
                'Tipo' => $product->product_type,
                'pH' => $product->ph_level,
                'Seguridad' => $product->safety_classification,
                'Ecológico' => $product->is_eco_friendly ? 'Sí' : 'No',
                'Antibacterial' => $product->is_antibacterial ? 'Sí' : 'No',
                'Biodegradable' => $product->is_biodegradable ? 'Sí' : 'No',
                'Concentrado' => $product->is_concentrated ? 'Sí' : 'No',
                'Rating Seguridad' => CleanProductHelper::getSafetyRating($product),
                'Score Ecológico' => CleanProductHelper::getEcoScore($product),
                'Creado' => $product->created_at->format('Y-m-d H:i:s'),
            ];
        });

        if ($format === 'csv') {
            return $this->exportToCsv($data, 'productos_limpieza.csv');
        }

        return $this->exportToJson($data, 'productos_limpieza.json');
    }

    /**
     * Generate safety report.
     */
    public function generateSafetyReport(string $type = 'full')
    {
        $report = [];

        if ($type === 'full' || $type === 'products') {
            $report['products'] = $this->getSafetyReports();
        }

        if ($type === 'full' || $type === 'ingredients') {
            $report['ingredients'] = $this->ingredientRepository->getStatistics();
        }

        if ($type === 'full' || $type === 'compliance') {
            $report['compliance'] = $this->getComplianceReport();
        }

        return Response::json($report);
    }

    /**
     * Bulk operations on products.
     */
    public function bulkOperation(string $operation, array $productIds, array $data = []): array
    {
        $results = ['success' => 0, 'failed' => 0, 'errors' => []];

        foreach ($productIds as $productId) {
            try {
                switch ($operation) {
                    case 'delete':
                        $this->productRepository->delete($productId);
                        $results['success']++;
                        break;
                    
                    case 'update_safety':
                        if (!empty($data['safety_classification'])) {
                            $this->productRepository->update($productId, [
                                'safety_classification' => $data['safety_classification']
                            ]);
                            $results['success']++;
                        }
                        break;
                    
                    case 'update_eco':
                        if (isset($data['is_eco_friendly'])) {
                            $this->productRepository->update($productId, [
                                'is_eco_friendly' => $data['is_eco_friendly']
                            ]);
                            $results['success']++;
                        }
                        break;
                }
            } catch (\Exception $e) {
                $results['failed']++;
                $results['errors'][] = "Producto {$productId}: " . $e->getMessage();
            }
        }

        return $results;
    }

    /**
     * Get product suggestions.
     */
    public function getProductSuggestions(string $query, int $limit = 10): array
    {
        $products = $this->productRepository->getModel()
            ->whereHas('product', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->with(['product', 'brand'])
            ->limit($limit)
            ->get();

        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->product->name ?? 'Producto #' . $product->id,
                'brand' => $product->brand->name ?? 'Sin marca',
                'safety' => $product->safety_classification,
            ];
        })->toArray();
    }

    /**
     * Get ingredient safety info.
     */
    public function getIngredientSafetyInfo(int $ingredientId): array
    {
        $ingredient = $this->ingredientRepository->findOrFail($ingredientId);
        
        return [
            'id' => $ingredient->id,
            'name' => $ingredient->name,
            'chemical_name' => $ingredient->chemical_name,
            'safety_level' => $ingredient->safety_level,
            'hazard_symbols' => $ingredient->hazard_symbols,
            'is_natural' => $ingredient->is_natural,
            'is_biodegradable' => $ingredient->is_biodegradable,
            'safety_instructions' => $ingredient->safety_instructions,
            'concentration_range' => $ingredient->getConcentrationRange(),
            'products_count' => $ingredient->products()->count(),
        ];
    }

    /**
     * Get eco trend data.
     */
    protected function getEcoTrend(): array
    {
        // Mock data for demonstration
        return [
            'current_month' => $this->productRepository->getEcoFriendly()->count(),
            'last_month' => $this->productRepository->getEcoFriendly()->count() - 5,
            'growth_rate' => '+12%'
        ];
    }

    /**
     * Get compliance report.
     */
    protected function getComplianceReport(): array
    {
        return [
            'products_with_safety_sheets' => $this->productRepository->getModel()
                ->whereNotNull('storage_conditions')
                ->count(),
            'products_without_hazard_info' => $this->productRepository->getModel()
                ->whereNull('precautions')
                ->count(),
            'eco_certified_products' => $this->productRepository->getModel()
                ->whereNotNull('certifications')
                ->count(),
        ];
    }

    /**
     * Export data to CSV.
     */
    protected function exportToCsv(Collection $data, string $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return Response::stream(function () use ($data) {
            $handle = fopen('php://output', 'w');
            
            // Add CSV headers
            if ($data->isNotEmpty()) {
                fputcsv($handle, array_keys($data->first()));
            }
            
            // Add data rows
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            
            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Export data to JSON.
     */
    protected function exportToJson(Collection $data, string $filename)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return Response::json($data, 200, $headers);
    }
}