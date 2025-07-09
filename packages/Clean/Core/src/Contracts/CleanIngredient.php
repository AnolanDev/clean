<?php

namespace Clean\Core\Contracts;

interface CleanIngredient
{
    /**
     * Get the ingredient name.
     */
    public function getName(): string;

    /**
     * Get the chemical name.
     */
    public function getChemicalName(): ?string;

    /**
     * Get the CAS number.
     */
    public function getCasNumber(): ?string;

    /**
     * Get the ingredient type.
     */
    public function getType(): string;

    /**
     * Get the safety level.
     */
    public function getSafetyLevel(): string;

    /**
     * Check if ingredient is natural.
     */
    public function isNatural(): bool;

    /**
     * Check if ingredient is biodegradable.
     */
    public function isBiodegradable(): bool;

    /**
     * Get hazard symbols.
     */
    public function getHazardSymbols(): array;

    /**
     * Get safety instructions.
     */
    public function getSafetyInstructions(): ?string;

    /**
     * Get concentration range.
     */
    public function getConcentrationRange(): array;

    /**
     * Get products using this ingredient.
     */
    public function getProducts();
}