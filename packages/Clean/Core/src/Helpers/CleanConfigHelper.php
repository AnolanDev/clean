<?php

namespace Clean\Core\Helpers;

use Clean\Core\Models\CleanSetting;

class CleanConfigHelper
{
    /**
     * Get configuration value.
     */
    public static function get(string $key, $default = null)
    {
        return CleanSetting::get($key, $default);
    }

    /**
     * Set configuration value.
     */
    public static function set(string $key, $value, string $type = 'text'): CleanSetting
    {
        return CleanSetting::set($key, $value, $type);
    }

    /**
     * Get all configurations by category.
     */
    public static function getByCategory(string $category): array
    {
        return CleanSetting::getByCategory($category);
    }

    /**
     * Get default clean product settings.
     */
    public static function getDefaultSettings(): array
    {
        return [
            'clean.general.enabled' => true,
            'clean.general.company_name' => 'Clean Products Store',
            'clean.general.support_email' => 'support@cleanstore.com',
            'clean.catalog.default_category' => null,
            'clean.catalog.show_eco_badge' => true,
            'clean.catalog.show_safety_rating' => true,
            'clean.catalog.show_ingredients' => true,
            'clean.catalog.require_safety_approval' => false,
            'clean.safety.max_hazardous_ingredients' => 3,
            'clean.safety.require_safety_data_sheet' => true,
            'clean.safety.show_hazard_symbols' => true,
            'clean.display.products_per_page' => 20,
            'clean.display.show_dilution_calculator' => true,
            'clean.display.show_coverage_calculator' => true,
            'clean.filters.enable_eco_filter' => true,
            'clean.filters.enable_safety_filter' => true,
            'clean.filters.enable_ingredient_filter' => true,
            'clean.filters.enable_brand_filter' => true,
            'clean.filters.enable_category_filter' => true,
        ];
    }

    /**
     * Initialize default settings.
     */
    public static function initializeDefaults(): void
    {
        $defaults = self::getDefaultSettings();

        foreach ($defaults as $key => $value) {
            if (!CleanSetting::where('key', $key)->exists()) {
                $type = is_bool($value) ? 'boolean' : 
                       (is_int($value) ? 'integer' : 'text');
                
                CleanSetting::create([
                    'key' => $key,
                    'value' => $value,
                    'type' => $type,
                    'category' => self::getCategoryFromKey($key),
                    'is_editable' => true
                ]);
            }
        }
    }

    /**
     * Get category from setting key.
     */
    private static function getCategoryFromKey(string $key): string
    {
        $parts = explode('.', $key);
        return $parts[1] ?? 'general';
    }

    /**
     * Check if eco-friendly features are enabled.
     */
    public static function isEcoFriendlyEnabled(): bool
    {
        return self::get('clean.catalog.show_eco_badge', true);
    }

    /**
     * Check if safety rating is enabled.
     */
    public static function isSafetyRatingEnabled(): bool
    {
        return self::get('clean.catalog.show_safety_rating', true);
    }

    /**
     * Check if ingredients display is enabled.
     */
    public static function isIngredientsDisplayEnabled(): bool
    {
        return self::get('clean.catalog.show_ingredients', true);
    }

    /**
     * Check if safety approval is required.
     */
    public static function isSafetyApprovalRequired(): bool
    {
        return self::get('clean.catalog.require_safety_approval', false);
    }

    /**
     * Get maximum allowed hazardous ingredients.
     */
    public static function getMaxHazardousIngredients(): int
    {
        return self::get('clean.safety.max_hazardous_ingredients', 3);
    }

    /**
     * Check if safety data sheet is required.
     */
    public static function isSafetyDataSheetRequired(): bool
    {
        return self::get('clean.safety.require_safety_data_sheet', true);
    }

    /**
     * Check if hazard symbols should be shown.
     */
    public static function shouldShowHazardSymbols(): bool
    {
        return self::get('clean.safety.show_hazard_symbols', true);
    }

    /**
     * Get products per page.
     */
    public static function getProductsPerPage(): int
    {
        return self::get('clean.display.products_per_page', 20);
    }

    /**
     * Check if dilution calculator is enabled.
     */
    public static function isDilutionCalculatorEnabled(): bool
    {
        return self::get('clean.display.show_dilution_calculator', true);
    }

    /**
     * Check if coverage calculator is enabled.
     */
    public static function isCoverageCalculatorEnabled(): bool
    {
        return self::get('clean.display.show_coverage_calculator', true);
    }

    /**
     * Get enabled filters.
     */
    public static function getEnabledFilters(): array
    {
        $filters = [];

        if (self::get('clean.filters.enable_eco_filter', true)) {
            $filters[] = 'eco';
        }

        if (self::get('clean.filters.enable_safety_filter', true)) {
            $filters[] = 'safety';
        }

        if (self::get('clean.filters.enable_ingredient_filter', true)) {
            $filters[] = 'ingredient';
        }

        if (self::get('clean.filters.enable_brand_filter', true)) {
            $filters[] = 'brand';
        }

        if (self::get('clean.filters.enable_category_filter', true)) {
            $filters[] = 'category';
        }

        return $filters;
    }

    /**
     * Get company information.
     */
    public static function getCompanyInfo(): array
    {
        return [
            'name' => self::get('clean.general.company_name', 'Clean Products Store'),
            'support_email' => self::get('clean.general.support_email', 'support@cleanstore.com'),
            'enabled' => self::get('clean.general.enabled', true),
        ];
    }

    /**
     * Get catalog settings.
     */
    public static function getCatalogSettings(): array
    {
        return [
            'default_category' => self::get('clean.catalog.default_category'),
            'show_eco_badge' => self::get('clean.catalog.show_eco_badge', true),
            'show_safety_rating' => self::get('clean.catalog.show_safety_rating', true),
            'show_ingredients' => self::get('clean.catalog.show_ingredients', true),
            'require_safety_approval' => self::get('clean.catalog.require_safety_approval', false),
        ];
    }

    /**
     * Get safety settings.
     */
    public static function getSafetySettings(): array
    {
        return [
            'max_hazardous_ingredients' => self::get('clean.safety.max_hazardous_ingredients', 3),
            'require_safety_data_sheet' => self::get('clean.safety.require_safety_data_sheet', true),
            'show_hazard_symbols' => self::get('clean.safety.show_hazard_symbols', true),
        ];
    }

    /**
     * Validate product against safety settings.
     */
    public static function validateProductSafety(array $productData): array
    {
        $errors = [];

        // Check hazardous ingredients limit
        if (isset($productData['hazardous_ingredients_count'])) {
            $maxHazardous = self::getMaxHazardousIngredients();
            if ($productData['hazardous_ingredients_count'] > $maxHazardous) {
                $errors[] = "Product contains {$productData['hazardous_ingredients_count']} hazardous ingredients, maximum allowed is {$maxHazardous}";
            }
        }

        // Check safety data sheet requirement
        if (self::isSafetyDataSheetRequired()) {
            if (empty($productData['safety_data_sheet'])) {
                $errors[] = "Safety data sheet is required for this product";
            }
        }

        // Check safety approval requirement
        if (self::isSafetyApprovalRequired()) {
            if (empty($productData['safety_approved'])) {
                $errors[] = "Safety approval is required for this product";
            }
        }

        return $errors;
    }
}