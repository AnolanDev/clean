<?php

namespace Clean\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Clean\Core\Contracts\CleanIngredient as CleanIngredientContract;

class CleanIngredient extends Model implements CleanIngredientContract
{
    protected $fillable = [
        'name',
        'chemical_name',
        'cas_number',
        'description',
        'type',
        'safety_level',
        'hazard_symbols',
        'is_natural',
        'is_biodegradable',
        'safety_instructions',
        'concentration_min',
        'concentration_max'
    ];

    protected $casts = [
        'hazard_symbols' => 'array',
        'is_natural' => 'boolean',
        'is_biodegradable' => 'boolean',
        'concentration_min' => 'decimal:2',
        'concentration_max' => 'decimal:2'
    ];

    /**
     * Get the ingredient name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the chemical name.
     */
    public function getChemicalName(): ?string
    {
        return $this->chemical_name;
    }

    /**
     * Get the CAS number.
     */
    public function getCasNumber(): ?string
    {
        return $this->cas_number;
    }

    /**
     * Get the ingredient type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the safety level.
     */
    public function getSafetyLevel(): string
    {
        return $this->safety_level;
    }

    /**
     * Check if ingredient is natural.
     */
    public function isNatural(): bool
    {
        return $this->is_natural;
    }

    /**
     * Check if ingredient is biodegradable.
     */
    public function isBiodegradable(): bool
    {
        return $this->is_biodegradable;
    }

    /**
     * Get hazard symbols.
     */
    public function getHazardSymbols(): array
    {
        return $this->hazard_symbols ?? [];
    }

    /**
     * Get safety instructions.
     */
    public function getSafetyInstructions(): ?string
    {
        return $this->safety_instructions;
    }

    /**
     * Get concentration range.
     */
    public function getConcentrationRange(): array
    {
        return [
            'min' => $this->concentration_min,
            'max' => $this->concentration_max
        ];
    }

    /**
     * Get products using this ingredient.
     */
    public function getProducts()
    {
        return $this->products();
    }

    /**
     * Relationship with clean products.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CleanProduct::class, 'clean_product_ingredients')
            ->withPivot(['concentration', 'is_active_ingredient', 'function_in_product'])
            ->withTimestamps();
    }

    /**
     * Scope by ingredient type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope by safety level.
     */
    public function scopeBySafetyLevel($query, $level)
    {
        return $query->where('safety_level', $level);
    }

    /**
     * Scope for natural ingredients.
     */
    public function scopeNatural($query)
    {
        return $query->where('is_natural', true);
    }

    /**
     * Scope for biodegradable ingredients.
     */
    public function scopeBiodegradable($query)
    {
        return $query->where('is_biodegradable', true);
    }

    /**
     * Scope for safe ingredients (low safety level).
     */
    public function scopeSafe($query)
    {
        return $query->where('safety_level', 'low');
    }

    /**
     * Scope for hazardous ingredients.
     */
    public function scopeHazardous($query)
    {
        return $query->where('safety_level', 'hazardous');
    }
}