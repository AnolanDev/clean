<?php

namespace Clean\Core\Repositories;

use Clean\Core\Models\CleanCategory;
use Illuminate\Database\Eloquent\Collection;

class CleanCategoryRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(CleanCategory $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all active categories.
     */
    public function getActive(): Collection
    {
        return $this->model->active()->ordered()->get();
    }

    /**
     * Get root categories.
     */
    public function getRootCategories(): Collection
    {
        return $this->model->active()->root()->ordered()->get();
    }

    /**
     * Get category tree structure.
     */
    public function getCategoryTree(): Collection
    {
        return $this->model->active()
            ->root()
            ->with(['children' => function ($query) {
                $query->active()->ordered();
            }])
            ->ordered()
            ->get();
    }

    /**
     * Find category by slug.
     */
    public function findBySlug(string $slug): ?CleanCategory
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get categories by usage area.
     */
    public function getByUsageArea(string $area): Collection
    {
        return $this->model->active()
            ->byUsageArea($area)
            ->ordered()
            ->get();
    }

    /**
     * Get categories by surface type.
     */
    public function getBySurfaceType(string $type): Collection
    {
        return $this->model->active()
            ->bySurfaceType($type)
            ->ordered()
            ->get();
    }

    /**
     * Get professional categories.
     */
    public function getProfessional(): Collection
    {
        return $this->model->active()
            ->professional()
            ->ordered()
            ->get();
    }

    /**
     * Get categories with product count.
     */
    public function getWithProductCount(): Collection
    {
        return $this->model->active()
            ->withCount('products')
            ->ordered()
            ->get();
    }

    /**
     * Get children of a category.
     */
    public function getChildren(int $parentId): Collection
    {
        return $this->model->active()
            ->where('parent_id', $parentId)
            ->ordered()
            ->get();
    }

    /**
     * Get categories that require dilution.
     */
    public function getRequiringDilution(): Collection
    {
        return $this->model->active()
            ->where('requires_dilution', true)
            ->ordered()
            ->get();
    }

    /**
     * Update category status.
     */
    public function updateStatus(int $id, bool $status): bool
    {
        $category = $this->findOrFail($id);
        
        return $category->update(['status' => $status]);
    }

    /**
     * Get popular categories (most products).
     */
    public function getPopular(int $limit = 10): Collection
    {
        return $this->model->active()
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get breadcrumb for category.
     */
    public function getBreadcrumb(int $categoryId): Collection
    {
        $category = $this->findOrFail($categoryId);
        $breadcrumb = collect([$category]);
        
        // Add ancestors
        $ancestors = $category->ancestors();
        $breadcrumb = $ancestors->merge($breadcrumb);
        
        return $breadcrumb;
    }

    /**
     * Get all descendants of a category.
     */
    public function getDescendants(int $categoryId): Collection
    {
        $category = $this->findOrFail($categoryId);
        
        return $category->descendants();
    }

    /**
     * Move category to new parent.
     */
    public function moveToParent(int $categoryId, ?int $newParentId): bool
    {
        $category = $this->findOrFail($categoryId);
        
        // Prevent moving to self or descendant
        if ($newParentId && $category->descendants()->contains('id', $newParentId)) {
            return false;
        }
        
        return $category->update(['parent_id' => $newParentId]);
    }

    /**
     * Get leaf categories (no children).
     */
    public function getLeafCategories(): Collection
    {
        return $this->model->active()
            ->whereDoesntHave('children')
            ->ordered()
            ->get();
    }
}