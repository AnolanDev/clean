<?php

namespace Clean\Core\Repositories;

use Clean\Core\Models\CleanProduct;
use Illuminate\Database\Eloquent\Collection;

class CleanProductRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(CleanProduct $model)
    {
        parent::__construct($model);
    }

    /**
     * Get eco-friendly products.
     */
    public function getEcoFriendly(): Collection
    {
        return $this->model->ecoFriendly()->get();
    }

    /**
     * Get biodegradable products.
     */
    public function getBiodegradable(): Collection
    {
        return $this->model->biodegradable()->get();
    }

    /**
     * Get antibacterial products.
     */
    public function getAntibacterial(): Collection
    {
        return $this->model->antibacterial()->get();
    }

    /**
     * Get antiviral products.
     */
    public function getAntiviral(): Collection
    {
        return $this->model->antiviral()->get();
    }

    /**
     * Get products by type.
     */
    public function getByType(string $type): Collection
    {
        return $this->model->byType($type)->get();
    }

    /**
     * Get products by pH level.
     */
    public function getByPhLevel(string $level): Collection
    {
        return $this->model->byPhLevel($level)->get();
    }

    /**
     * Get products by safety classification.
     */
    public function getBySafetyLevel(string $level): Collection
    {
        return $this->model->bySafetyLevel($level)->get();
    }

    /**
     * Get concentrated products.
     */
    public function getConcentrated(): Collection
    {
        return $this->model->concentrated()->get();
    }

    /**
     * Get safe products.
     */
    public function getSafe(): Collection
    {
        return $this->model->safe()->get();
    }

    /**
     * Get products by brand.
     */
    public function getByBrand(int $brandId): Collection
    {
        return $this->model->where('clean_brand_id', $brandId)
            ->with(['product', 'brand', 'category'])
            ->get();
    }

    /**
     * Get products by category.
     */
    public function getByCategory(int $categoryId): Collection
    {
        return $this->model->where('clean_category_id', $categoryId)
            ->with(['product', 'brand', 'category'])
            ->get();
    }

    /**
     * Get products with ingredients.
     */
    public function getWithIngredients(): Collection
    {
        return $this->model->with(['ingredients'])->get();
    }

    /**
     * Get products by ingredient.
     */
    public function getByIngredient(int $ingredientId): Collection
    {
        return $this->model->whereHas('ingredients', function ($query) use ($ingredientId) {
            $query->where('clean_ingredient_id', $ingredientId);
        })->get();
    }

    /**
     * Get products without hazardous ingredients.
     */
    public function getWithoutHazardousIngredients(): Collection
    {
        return $this->model->whereDoesntHave('ingredients', function ($query) {
            $query->where('safety_level', 'hazardous');
        })->get();
    }

    /**
     * Get products with natural ingredients only.
     */
    public function getWithNaturalIngredients(): Collection
    {
        return $this->model->whereHas('ingredients', function ($query) {
            $query->where('is_natural', true);
        })->get();
    }

    /**
     * Filter products by multiple criteria.
     */
    public function filterProducts(array $filters): Collection
    {
        $query = $this->model->query();

        if (isset($filters['eco_friendly'])) {
            $query->where('is_eco_friendly', $filters['eco_friendly']);
        }

        if (isset($filters['biodegradable'])) {
            $query->where('is_biodegradable', $filters['biodegradable']);
        }

        if (isset($filters['antibacterial'])) {
            $query->where('is_antibacterial', $filters['antibacterial']);
        }

        if (isset($filters['antiviral'])) {
            $query->where('is_antiviral', $filters['antiviral']);
        }

        if (isset($filters['product_type'])) {
            $query->where('product_type', $filters['product_type']);
        }

        if (isset($filters['ph_level'])) {
            $query->where('ph_level', $filters['ph_level']);
        }

        if (isset($filters['safety_level'])) {
            $query->where('safety_classification', $filters['safety_level']);
        }

        if (isset($filters['brand_id'])) {
            $query->where('clean_brand_id', $filters['brand_id']);
        }

        if (isset($filters['category_id'])) {
            $query->where('clean_category_id', $filters['category_id']);
        }

        if (isset($filters['concentrated'])) {
            $query->where('is_concentrated', $filters['concentrated']);
        }

        return $query->with(['product', 'brand', 'category'])->get();
    }

    /**
     * Get products for professional use.
     */
    public function getProfessionalUse(): Collection
    {
        return $this->model->whereHas('category', function ($query) {
            $query->where('professional_use', true);
        })->get();
    }

    /**
     * Get products by usage area.
     */
    public function getByUsageArea(string $area): Collection
    {
        return $this->model->whereHas('category', function ($query) use ($area) {
            $query->where('usage_area', $area);
        })->get();
    }

    /**
     * Get products by surface type.
     */
    public function getBySurfaceType(string $type): Collection
    {
        return $this->model->whereHas('category', function ($query) use ($type) {
            $query->where('surface_type', $type);
        })->get();
    }

    /**
     * Get products that require dilution.
     */
    public function getRequiringDilution(): Collection
    {
        return $this->model->whereHas('category', function ($query) {
            $query->where('requires_dilution', true);
        })->get();
    }
}