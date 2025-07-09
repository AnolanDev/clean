<?php

namespace Clean\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CleanCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'icon',
        'parent_id',
        'sort_order',
        'status',
        'metadata',
        'usage_area',
        'surface_type',
        'requires_dilution',
        'professional_use'
    ];

    protected $casts = [
        'metadata' => 'array',
        'status' => 'boolean',
        'requires_dilution' => 'boolean',
        'professional_use' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relationship with parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(CleanCategory::class, 'parent_id');
    }

    /**
     * Relationship with child categories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(CleanCategory::class, 'parent_id');
    }

    /**
     * Relationship with clean products.
     */
    public function products(): HasMany
    {
        return $this->hasMany(CleanProduct::class, 'clean_category_id');
    }

    /**
     * Get all ancestors (parent, grandparent, etc.).
     */
    public function ancestors()
    {
        $ancestors = collect();
        $category = $this->parent;
        
        while ($category) {
            $ancestors->push($category);
            $category = $category->parent;
        }
        
        return $ancestors->reverse();
    }

    /**
     * Get all descendants (children, grandchildren, etc.).
     */
    public function descendants()
    {
        $descendants = collect();
        
        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->descendants());
        }
        
        return $descendants;
    }

    /**
     * Check if category is root (has no parent).
     */
    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Check if category is leaf (has no children).
     */
    public function isLeaf(): bool
    {
        return $this->children()->count() === 0;
    }

    /**
     * Scope for active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for root categories.
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope for ordered categories.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope by usage area.
     */
    public function scopeByUsageArea($query, $area)
    {
        return $query->where('usage_area', $area);
    }

    /**
     * Scope by surface type.
     */
    public function scopeBySurfaceType($query, $type)
    {
        return $query->where('surface_type', $type);
    }

    /**
     * Scope for professional use.
     */
    public function scopeProfessional($query)
    {
        return $query->where('professional_use', true);
    }
}