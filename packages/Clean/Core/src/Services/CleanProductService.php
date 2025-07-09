<?php

namespace Clean\Core\Services;

use Clean\Core\Models\CleanProduct;
use Clean\Core\Models\CleanBrand;
use Clean\Core\Models\CleanCategory;
use Clean\Core\Models\CleanIngredient;
use Clean\Core\Repositories\CleanProductRepository;
use Clean\Core\Repositories\CleanBrandRepository;
use Clean\Core\Repositories\CleanCategoryRepository;
use Clean\Core\Repositories\CleanIngredientRepository;
use Clean\Core\Helpers\CleanProductHelper;
use Clean\Core\Helpers\CleanConfigHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CleanProductService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected CleanProductRepository $productRepository,
        protected CleanBrandRepository $brandRepository,
        protected CleanCategoryRepository $categoryRepository,
        protected CleanIngredientRepository $ingredientRepository
    ) {}

    /**
     * Get filtered products.
     */
    public function getFilteredProducts(array $filters = []): Collection
    {
        return $this->productRepository->filterProducts($filters);
    }

    /**
     * Get paginated products.
     */
    public function getPaginatedProducts(array $filters = [], int $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?: CleanConfigHelper::getProductsPerPage();
        
        $query = $this->productRepository->getModel()->query();

        // Apply filters
        if (!empty($filters)) {
            $query = $this->applyFilters($query, $filters);
        }

        return $query->with(['product', 'brand', 'category'])
            ->paginate($perPage);
    }

    /**
     * Get product recommendations.
     */
    public function getRecommendations(CleanProduct $product, int $limit = 5): Collection
    {
        // Get products from same category
        $sameCategory = $this->productRepository->getByCategory($product->clean_category_id)
            ->where('id', '!=', $product->id)
            ->take($limit);

        // If not enough, get from same brand
        if ($sameCategory->count() < $limit) {
            $sameBrand = $this->productRepository->getByBrand($product->clean_brand_id)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $sameCategory->pluck('id'))
                ->take($limit - $sameCategory->count());

            $sameCategory = $sameCategory->merge($sameBrand);
        }

        // If still not enough, get eco-friendly products
        if ($sameCategory->count() < $limit && $product->is_eco_friendly) {
            $ecoProducts = $this->productRepository->getEcoFriendly()
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $sameCategory->pluck('id'))
                ->take($limit - $sameCategory->count());

            $sameCategory = $sameCategory->merge($ecoProducts);
        }

        return $sameCategory->take($limit);
    }

    /**
     * Get product statistics.
     */
    public function getProductStatistics(): array
    {
        $total = $this->productRepository->getModel()->count();
        $ecoFriendly = $this->productRepository->getEcoFriendly()->count();
        $biodegradable = $this->productRepository->getBiodegradable()->count();
        $antibacterial = $this->productRepository->getAntibacterial()->count();
        $antiviral = $this->productRepository->getAntiviral()->count();
        $concentrated = $this->productRepository->getConcentrated()->count();
        $safe = $this->productRepository->getSafe()->count();

        // Get statistics by type
        $byType = $this->productRepository->getModel()
            ->selectRaw('product_type, COUNT(*) as count')
            ->groupBy('product_type')
            ->get()
            ->pluck('count', 'product_type')
            ->toArray();

        // Get statistics by safety level
        $bySafetyLevel = $this->productRepository->getModel()
            ->selectRaw('safety_classification, COUNT(*) as count')
            ->groupBy('safety_classification')
            ->get()
            ->pluck('count', 'safety_classification')
            ->toArray();

        return [
            'total' => $total,
            'eco_friendly' => $ecoFriendly,
            'biodegradable' => $biodegradable,
            'antibacterial' => $antibacterial,
            'antiviral' => $antiviral,
            'concentrated' => $concentrated,
            'safe' => $safe,
            'by_type' => $byType,
            'by_safety_level' => $bySafetyLevel,
        ];
    }

    /**
     * Create product with ingredients.
     */
    public function createProductWithIngredients(array $productData, array $ingredients = []): CleanProduct
    {
        // Validate product safety
        $safetyErrors = CleanConfigHelper::validateProductSafety($productData);
        if (!empty($safetyErrors)) {
            throw new \Exception('Product safety validation failed: ' . implode(', ', $safetyErrors));
        }

        // Create product
        $product = $this->productRepository->create($productData);

        // Attach ingredients
        if (!empty($ingredients)) {
            $this->attachIngredients($product, $ingredients);
        }

        return $product->load(['ingredients', 'brand', 'category']);
    }

    /**
     * Update product with ingredients.
     */
    public function updateProductWithIngredients(int $productId, array $productData, array $ingredients = []): CleanProduct
    {
        // Validate product safety
        $safetyErrors = CleanConfigHelper::validateProductSafety($productData);
        if (!empty($safetyErrors)) {
            throw new \Exception('Product safety validation failed: ' . implode(', ', $safetyErrors));
        }

        // Update product
        $product = $this->productRepository->update($productId, $productData);

        // Update ingredients
        if (!empty($ingredients)) {
            $this->syncIngredients($product, $ingredients);
        }

        return $product->load(['ingredients', 'brand', 'category']);
    }

    /**
     * Get product with enriched data.
     */
    public function getEnrichedProduct(int $productId): array
    {
        $product = $this->productRepository->findOrFail($productId);
        $product->load(['ingredients', 'brand', 'category', 'product']);

        return [
            'product' => $product,
            'safety_rating' => CleanProductHelper::getSafetyRating($product),
            'eco_score' => CleanProductHelper::getEcoScore($product),
            'effectiveness_score' => CleanProductHelper::getEffectivenessScore($product),
            'features' => CleanProductHelper::getProductFeatures($product),
            'warnings' => CleanProductHelper::getCompatibilityWarnings($product),
            'recommendations' => CleanProductHelper::getUsageRecommendations($product),
            'dilution_info' => $product->is_concentrated ? 
                CleanProductHelper::calculateDilution($product, 1000) : null,
            'coverage_info' => $product->coverage_area ? 
                CleanProductHelper::calculateCoverage($product, 1000) : null,
        ];
    }

    /**
     * Search products.
     */
    public function searchProducts(string $query, array $filters = []): Collection
    {
        $searchQuery = $this->productRepository->getModel()->query();

        // Search in product name and description
        $searchQuery->whereHas('product', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%");
        });

        // Search in brand name
        $searchQuery->orWhereHas('brand', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        });

        // Search in category name
        $searchQuery->orWhereHas('category', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        });

        // Search in ingredients
        $searchQuery->orWhereHas('ingredients', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('chemical_name', 'LIKE', "%{$query}%");
        });

        // Apply additional filters
        if (!empty($filters)) {
            $searchQuery = $this->applyFilters($searchQuery, $filters);
        }

        return $searchQuery->with(['product', 'brand', 'category'])->get();
    }

    /**
     * Get products by safety level.
     */
    public function getProductsBySafetyLevel(string $safetyLevel): Collection
    {
        return $this->productRepository->getBySafetyLevel($safetyLevel);
    }

    /**
     * Get professional products.
     */
    public function getProfessionalProducts(): Collection
    {
        return $this->productRepository->getProfessionalUse();
    }

    /**
     * Apply filters to query.
     */
    private function applyFilters($query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            switch ($key) {
                case 'eco_friendly':
                    $query->where('is_eco_friendly', $value);
                    break;
                case 'biodegradable':
                    $query->where('is_biodegradable', $value);
                    break;
                case 'antibacterial':
                    $query->where('is_antibacterial', $value);
                    break;
                case 'antiviral':
                    $query->where('is_antiviral', $value);
                    break;
                case 'product_type':
                    $query->where('product_type', $value);
                    break;
                case 'ph_level':
                    $query->where('ph_level', $value);
                    break;
                case 'safety_level':
                    $query->where('safety_classification', $value);
                    break;
                case 'brand_id':
                    $query->where('clean_brand_id', $value);
                    break;
                case 'category_id':
                    $query->where('clean_category_id', $value);
                    break;
                case 'concentrated':
                    $query->where('is_concentrated', $value);
                    break;
                case 'usage_area':
                    $query->whereHas('category', function ($q) use ($value) {
                        $q->where('usage_area', $value);
                    });
                    break;
                case 'surface_type':
                    $query->whereHas('category', function ($q) use ($value) {
                        $q->where('surface_type', $value);
                    });
                    break;
            }
        }

        return $query;
    }

    /**
     * Attach ingredients to product.
     */
    private function attachIngredients(CleanProduct $product, array $ingredients): void
    {
        $ingredientData = [];

        foreach ($ingredients as $ingredient) {
            $ingredientData[$ingredient['ingredient_id']] = [
                'concentration' => $ingredient['concentration'] ?? null,
                'is_active_ingredient' => $ingredient['is_active_ingredient'] ?? false,
                'function_in_product' => $ingredient['function_in_product'] ?? null,
            ];
        }

        $product->ingredients()->attach($ingredientData);
    }

    /**
     * Sync ingredients to product.
     */
    private function syncIngredients(CleanProduct $product, array $ingredients): void
    {
        $ingredientData = [];

        foreach ($ingredients as $ingredient) {
            $ingredientData[$ingredient['ingredient_id']] = [
                'concentration' => $ingredient['concentration'] ?? null,
                'is_active_ingredient' => $ingredient['is_active_ingredient'] ?? false,
                'function_in_product' => $ingredient['function_in_product'] ?? null,
            ];
        }

        $product->ingredients()->sync($ingredientData);
    }
}