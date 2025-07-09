<?php

namespace Clean\Core\Repositories;

use Clean\Core\Models\CleanBrand;
use Illuminate\Database\Eloquent\Collection;

class CleanBrandRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(CleanBrand $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all active brands.
     */
    public function getActive(): Collection
    {
        return $this->model->active()->ordered()->get();
    }

    /**
     * Get eco-friendly brands.
     */
    public function getEcoFriendly(): Collection
    {
        return $this->model->active()->ecoFriendly()->ordered()->get();
    }

    /**
     * Find brand by slug.
     */
    public function findBySlug(string $slug): ?CleanBrand
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get brands with product count.
     */
    public function getWithProductCount(): Collection
    {
        return $this->model->active()
            ->withCount('products')
            ->ordered()
            ->get();
    }

    /**
     * Search brands by name.
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->active()
            ->where('name', 'LIKE', "%{$name}%")
            ->ordered()
            ->get();
    }

    /**
     * Get brands by country.
     */
    public function getByCountry(string $country): Collection
    {
        return $this->model->active()
            ->where('country', $country)
            ->ordered()
            ->get();
    }

    /**
     * Get brands with certifications.
     */
    public function getWithCertifications(): Collection
    {
        return $this->model->active()
            ->whereNotNull('certifications')
            ->ordered()
            ->get();
    }

    /**
     * Update brand status.
     */
    public function updateStatus(int $id, bool $status): bool
    {
        $brand = $this->findOrFail($id);
        
        return $brand->update(['status' => $status]);
    }

    /**
     * Get popular brands (most products).
     */
    public function getPopular(int $limit = 10): Collection
    {
        return $this->model->active()
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit($limit)
            ->get();
    }
}