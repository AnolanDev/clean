<?php

namespace Clean\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Clean\Core\Contracts\CleanBrand as CleanBrandContract;

class CleanBrand extends Model implements CleanBrandContract
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'website',
        'country',
        'is_eco_friendly',
        'certifications',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'is_eco_friendly' => 'boolean',
        'certifications' => 'array',
        'status' => 'boolean',
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
     * Get the brand name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the brand slug.
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Check if the brand is eco-friendly.
     */
    public function isEcoFriendly(): bool
    {
        return $this->is_eco_friendly;
    }

    /**
     * Get the brand certifications.
     */
    public function getCertifications(): array
    {
        return $this->certifications ?? [];
    }

    /**
     * Get the brand status.
     */
    public function isActive(): bool
    {
        return $this->status;
    }

    /**
     * Get associated products.
     */
    public function getProducts()
    {
        return $this->products();
    }

    /**
     * Relationship with clean products.
     */
    public function products(): HasMany
    {
        return $this->hasMany(CleanProduct::class, 'clean_brand_id');
    }

    /**
     * Scope for active brands.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for eco-friendly brands.
     */
    public function scopeEcoFriendly($query)
    {
        return $query->where('is_eco_friendly', true);
    }

    /**
     * Scope for ordered brands.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}