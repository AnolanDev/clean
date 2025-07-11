<?php

namespace Clean\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Webkul\Product\Models\Product;
use Clean\Core\Contracts\CleanProduct as CleanProductContract;

class CleanProduct extends Model implements CleanProductContract
{
    protected $fillable = [
        'product_id',
        'clean_brand_id',
        'clean_category_id',
        // Nuevos campos del catálogo
        'name',
        'description',
        'benefits',
        'presentations',
        'available_fragrances',
        'usage_types',
        'catalog_source',
        'is_concentrated_formula',
        'concentration_percentage',
        'food_contact_safe',
        'no_residue',
        'fabric_safe',
        'yield_information',
        // Campos existentes
        'product_type',
        'ph_level',
        'ph_value',
        'usage_instructions',
        'dilution_ratio',
        'coverage_area',
        'contact_time',
        'is_concentrated',
        'is_antibacterial',
        'is_antiviral',
        'is_antifungal',
        'is_eco_friendly',
        'is_biodegradable',
        'is_phosphate_free',
        'is_chlorine_free',
        'is_ammonia_free',
        'is_fragrance_free',
        'safety_classification',
        'precautions',
        'first_aid',
        'storage_conditions',
        'certifications',
        'compatible_surfaces',
        'incompatible_with',
        'color',
        'fragrance',
        'density',
        'shelf_life_months',
        'packaging_material'
    ];

    protected $casts = [
        // Nuevos campos
        'presentations' => 'array',
        'available_fragrances' => 'array',
        'usage_types' => 'array',
        'is_concentrated_formula' => 'boolean',
        'food_contact_safe' => 'boolean',
        'no_residue' => 'boolean',
        'fabric_safe' => 'boolean',
        // Campos existentes
        'ph_value' => 'decimal:1',
        'coverage_area' => 'integer',
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
        'precautions' => 'array',
        'first_aid' => 'array',
        'certifications' => 'array',
        'compatible_surfaces' => 'array',
        'incompatible_with' => 'array',
        'density' => 'decimal:3',
        'shelf_life_months' => 'integer'
    ];

    /**
     * Get the product type.
     */
    public function getProductType(): ?string
    {
        return $this->product_type;
    }

    /**
     * Get the pH level.
     */
    public function getPhLevel(): ?string
    {
        return $this->ph_level;
    }

    /**
     * Get the pH value.
     */
    public function getPhValue(): ?float
    {
        return $this->ph_value;
    }

    /**
     * Check if product is concentrated.
     */
    public function isConcentrated(): bool
    {
        return $this->is_concentrated;
    }

    /**
     * Check if product is eco-friendly.
     */
    public function isEcoFriendly(): bool
    {
        return $this->is_eco_friendly;
    }

    /**
     * Check if product is biodegradable.
     */
    public function isBiodegradable(): bool
    {
        return $this->is_biodegradable;
    }

    /**
     * Check if product has antibacterial properties.
     */
    public function isAntibacterial(): bool
    {
        return $this->is_antibacterial;
    }

    /**
     * Check if product has antiviral properties.
     */
    public function isAntiviral(): bool
    {
        return $this->is_antiviral;
    }

    /**
     * Get safety classification.
     */
    public function getSafetyClassification(): string
    {
        return $this->safety_classification;
    }

    /**
     * Get usage instructions.
     */
    public function getUsageInstructions(): ?string
    {
        return $this->usage_instructions;
    }

    /**
     * Get dilution ratio.
     */
    public function getDilutionRatio(): ?string
    {
        return $this->dilution_ratio;
    }

    /**
     * Get product ingredients.
     */
    public function getIngredients()
    {
        return $this->ingredients();
    }

    /**
     * Get compatible surfaces.
     */
    public function getCompatibleSurfaces(): array
    {
        return $this->compatible_surfaces ?? [];
    }

    /**
     * Get certifications.
     */
    public function getCertifications(): array
    {
        return $this->certifications ?? [];
    }

    /**
     * Get brand.
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get category.
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Relationship with main product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relationship with clean brand.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(CleanBrand::class, 'clean_brand_id');
    }

    /**
     * Relationship with clean category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CleanCategory::class, 'clean_category_id');
    }

    /**
     * Relationship with ingredients.
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(CleanIngredient::class, 'clean_product_ingredients')
            ->withPivot(['concentration', 'is_active_ingredient', 'function_in_product'])
            ->withTimestamps();
    }

    /**
     * Get active ingredients only.
     */
    public function activeIngredients(): BelongsToMany
    {
        return $this->ingredients()->wherePivot('is_active_ingredient', true);
    }

    /**
     * Check if product is safe (non-hazardous).
     */
    public function isSafe(): bool
    {
        return $this->safety_classification === 'non_hazardous';
    }

    /**
     * Check if product is professional use.
     */
    public function isProfessionalUse(): bool
    {
        return $this->category && $this->category->professional_use;
    }

    /**
     * Scope for eco-friendly products.
     */
    public function scopeEcoFriendly($query)
    {
        return $query->where('is_eco_friendly', true);
    }

    /**
     * Scope for biodegradable products.
     */
    public function scopeBiodegradable($query)
    {
        return $query->where('is_biodegradable', true);
    }

    /**
     * Scope for antibacterial products.
     */
    public function scopeAntibacterial($query)
    {
        return $query->where('is_antibacterial', true);
    }

    /**
     * Scope for antiviral products.
     */
    public function scopeAntiviral($query)
    {
        return $query->where('is_antiviral', true);
    }

    /**
     * Scope by product type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('product_type', $type);
    }

    /**
     * Scope by pH level.
     */
    public function scopeByPhLevel($query, $level)
    {
        return $query->where('ph_level', $level);
    }

    /**
     * Scope by safety classification.
     */
    public function scopeBySafetyLevel($query, $level)
    {
        return $query->where('safety_classification', $level);
    }

    /**
     * Scope for concentrated products.
     */
    public function scopeConcentrated($query)
    {
        return $query->where('is_concentrated', true);
    }

    /**
     * Scope for safe products.
     */
    public function scopeSafe($query)
    {
        return $query->where('safety_classification', 'non_hazardous');
    }
}