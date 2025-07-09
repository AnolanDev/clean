<?php

namespace Clean\Catalog\Services;

use Clean\Core\Repositories\CleanProductRepository;
use Clean\Core\Repositories\CleanBrandRepository;
use Clean\Core\Repositories\CleanCategoryRepository;
use Clean\Core\Services\CleanProductService;
use Clean\Core\Helpers\CleanProductHelper;
use Illuminate\Database\Eloquent\Collection;

class CatalogService
{
    public function __construct(
        protected CleanProductRepository $productRepository,
        protected CleanBrandRepository $brandRepository,
        protected CleanCategoryRepository $categoryRepository,
        protected CleanProductService $productService
    ) {}

    /**
     * Get filtered products for catalog.
     */
    public function getFilteredProducts(array $filters = []): Collection
    {
        return $this->productService->getFilteredProducts($filters);
    }

    /**
     * Get product details with enriched data.
     */
    public function getProductDetails(int $productId): array
    {
        return $this->productService->getEnrichedProduct($productId);
    }

    /**
     * Get product recommendations.
     */
    public function getRecommendations($product, int $limit = 4): Collection
    {
        return $this->productService->getRecommendations($product, $limit);
    }

    /**
     * Search products.
     */
    public function searchProducts(string $query, array $filters = []): Collection
    {
        return $this->productService->searchProducts($query, $filters);
    }

    /**
     * Calculate dilution for a product.
     */
    public function calculateDilution(int $productId, float $volume): array
    {
        $product = $this->productRepository->findOrFail($productId);
        
        return CleanProductHelper::calculateDilution($product, $volume);
    }

    /**
     * Calculate coverage for a product.
     */
    public function calculateCoverage(int $productId, float $amount): array
    {
        $product = $this->productRepository->findOrFail($productId);
        
        return CleanProductHelper::calculateCoverage($product, $amount);
    }

    /**
     * Compare multiple products.
     */
    public function compareProducts(array $productIds): array
    {
        $products = [];
        $comparisons = [];

        foreach ($productIds as $id) {
            $products[$id] = $this->getProductDetails($id);
        }

        // Generate pairwise comparisons
        for ($i = 0; $i < count($productIds) - 1; $i++) {
            for ($j = $i + 1; $j < count($productIds); $j++) {
                $product1 = $products[$productIds[$i]]['product'];
                $product2 = $products[$productIds[$j]]['product'];
                
                $comparisons[] = CleanProductHelper::compareProducts($product1, $product2);
            }
        }

        return [
            'products' => $products,
            'comparisons' => $comparisons
        ];
    }

    /**
     * Get catalog statistics.
     */
    public function getCatalogStatistics(): array
    {
        return [
            'total_products' => $this->productRepository->getModel()->count(),
            'eco_friendly' => $this->productRepository->getEcoFriendly()->count(),
            'brands' => $this->brandRepository->getActive()->count(),
            'categories' => $this->categoryRepository->getActive()->count(),
            'professional_products' => $this->productRepository->getProfessionalUse()->count(),
            'safe_products' => $this->productRepository->getSafe()->count(),
        ];
    }

    /**
     * Get available product types.
     */
    public function getProductTypes(): array
    {
        return [
            'liquid' => 'Líquido',
            'powder' => 'Polvo',
            'gel' => 'Gel',
            'foam' => 'Espuma',
            'spray' => 'Spray',
            'wipes' => 'Toallitas',
            'concentrate' => 'Concentrado',
            'paste' => 'Pasta',
            'granules' => 'Gránulos',
            'tablet' => 'Tableta'
        ];
    }

    /**
     * Get available pH levels.
     */
    public function getPhLevels(): array
    {
        return [
            'acidic' => 'Ácido',
            'neutral' => 'Neutro',
            'alkaline' => 'Alcalino',
            'variable' => 'Variable'
        ];
    }

    /**
     * Get safety levels.
     */
    public function getSafetyLevels(): array
    {
        return [
            'non_hazardous' => 'No peligroso',
            'irritant' => 'Irritante',
            'corrosive' => 'Corrosivo',
            'toxic' => 'Tóxico',
            'flammable' => 'Inflamable'
        ];
    }

    /**
     * Get usage areas.
     */
    public function getUsageAreas(): array
    {
        return [
            'kitchen' => 'Cocina',
            'bathroom' => 'Baño',
            'floor' => 'Suelos',
            'glass' => 'Cristales',
            'furniture' => 'Muebles',
            'laundry' => 'Lavandería',
            'dishwash' => 'Lavavajillas',
            'multi_purpose' => 'Multiusos',
            'industrial' => 'Industrial'
        ];
    }

    /**
     * Get surface types.
     */
    public function getSurfaceTypes(): array
    {
        return [
            'hard_surface' => 'Superficie dura',
            'soft_surface' => 'Superficie blanda',
            'mixed' => 'Mixto',
            'specialized' => 'Especializado'
        ];
    }

    /**
     * Get featured products.
     */
    public function getFeaturedProducts(int $limit = 8): Collection
    {
        return $this->productRepository->getEcoFriendly()->take($limit);
    }

    /**
     * Get latest products.
     */
    public function getLatestProducts(int $limit = 6): Collection
    {
        return $this->productRepository->orderBy('created_at', 'desc')->take($limit);
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
     * Get eco-friendly products.
     */
    public function getEcoFriendlyProducts(): Collection
    {
        return $this->productRepository->getEcoFriendly();
    }

    /**
     * Get product safety recommendations.
     */
    public function getProductSafetyInfo(int $productId): array
    {
        $product = $this->productRepository->findOrFail($productId);
        
        return [
            'safety_rating' => CleanProductHelper::getSafetyRating($product),
            'warnings' => CleanProductHelper::getCompatibilityWarnings($product),
            'recommendations' => CleanProductHelper::getUsageRecommendations($product),
            'classification' => $product->safety_classification,
            'hazardous_ingredients' => $product->ingredients()
                ->where('safety_level', 'hazardous')
                ->count()
        ];
    }
}