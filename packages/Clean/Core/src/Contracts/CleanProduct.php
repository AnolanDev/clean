<?php

namespace Clean\Core\Contracts;

interface CleanProduct
{
    /**
     * Get the product type.
     */
    public function getProductType(): ?string;

    /**
     * Get the pH level.
     */
    public function getPhLevel(): ?string;

    /**
     * Get the pH value.
     */
    public function getPhValue(): ?float;

    /**
     * Check if product is concentrated.
     */
    public function isConcentrated(): bool;

    /**
     * Check if product is eco-friendly.
     */
    public function isEcoFriendly(): bool;

    /**
     * Check if product is biodegradable.
     */
    public function isBiodegradable(): bool;

    /**
     * Check if product has antibacterial properties.
     */
    public function isAntibacterial(): bool;

    /**
     * Check if product has antiviral properties.
     */
    public function isAntiviral(): bool;

    /**
     * Get safety classification.
     */
    public function getSafetyClassification(): string;

    /**
     * Get usage instructions.
     */
    public function getUsageInstructions(): ?string;

    /**
     * Get dilution ratio.
     */
    public function getDilutionRatio(): ?string;

    /**
     * Get product ingredients.
     */
    public function getIngredients();

    /**
     * Get compatible surfaces.
     */
    public function getCompatibleSurfaces(): array;

    /**
     * Get certifications.
     */
    public function getCertifications(): array;

    /**
     * Get brand.
     */
    public function getBrand();

    /**
     * Get category.
     */
    public function getCategory();
}