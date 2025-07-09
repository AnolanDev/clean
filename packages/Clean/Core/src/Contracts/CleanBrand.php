<?php

namespace Clean\Core\Contracts;

interface CleanBrand
{
    /**
     * Get the brand name.
     */
    public function getName(): string;

    /**
     * Get the brand slug.
     */
    public function getSlug(): string;

    /**
     * Check if the brand is eco-friendly.
     */
    public function isEcoFriendly(): bool;

    /**
     * Get the brand certifications.
     */
    public function getCertifications(): array;

    /**
     * Get the brand status.
     */
    public function isActive(): bool;

    /**
     * Get associated products.
     */
    public function getProducts();
}