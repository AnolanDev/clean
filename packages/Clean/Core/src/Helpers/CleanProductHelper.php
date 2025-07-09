<?php

namespace Clean\Core\Helpers;

use Clean\Core\Models\CleanProduct;
use Clean\Core\Models\CleanIngredient;

class CleanProductHelper
{
    /**
     * Get product safety rating (1-5 stars).
     */
    public static function getSafetyRating(CleanProduct $product): int
    {
        $rating = 5; // Start with max safety

        // Reduce rating based on safety classification
        switch ($product->safety_classification) {
            case 'toxic':
                $rating = 1;
                break;
            case 'corrosive':
                $rating = 2;
                break;
            case 'flammable':
                $rating = 3;
                break;
            case 'irritant':
                $rating = 4;
                break;
            case 'non_hazardous':
            default:
                $rating = 5;
                break;
        }

        // Reduce rating if contains hazardous ingredients
        $hazardousIngredients = $product->ingredients()
            ->where('safety_level', 'hazardous')
            ->count();

        if ($hazardousIngredients > 0) {
            $rating = max(1, $rating - $hazardousIngredients);
        }

        return $rating;
    }

    /**
     * Get eco-friendliness score (1-10).
     */
    public static function getEcoScore(CleanProduct $product): int
    {
        $score = 0;

        // Base points for eco-friendly features
        if ($product->is_eco_friendly) $score += 3;
        if ($product->is_biodegradable) $score += 2;
        if ($product->is_phosphate_free) $score += 1;
        if ($product->is_chlorine_free) $score += 1;
        if ($product->is_ammonia_free) $score += 1;

        // Points for natural ingredients
        $naturalIngredients = $product->ingredients()
            ->where('is_natural', true)
            ->count();
        $totalIngredients = $product->ingredients()->count();

        if ($totalIngredients > 0) {
            $naturalRatio = $naturalIngredients / $totalIngredients;
            $score += round($naturalRatio * 2); // Max 2 points
        }

        return min(10, max(1, $score));
    }

    /**
     * Get effectiveness score based on active ingredients.
     */
    public static function getEffectivenessScore(CleanProduct $product): int
    {
        $score = 5; // Base score

        // Add points for antimicrobial properties
        if ($product->is_antibacterial) $score += 1;
        if ($product->is_antiviral) $score += 1;
        if ($product->is_antifungal) $score += 1;

        // Add points for concentration
        if ($product->is_concentrated) $score += 1;

        // Add points for active ingredients
        $activeIngredients = $product->ingredients()
            ->wherePivot('is_active_ingredient', true)
            ->count();

        $score += min(2, $activeIngredients);

        return min(10, $score);
    }

    /**
     * Get dilution calculator.
     */
    public static function calculateDilution(CleanProduct $product, float $volumeNeeded): array
    {
        if (!$product->is_concentrated || !$product->dilution_ratio) {
            return [
                'product_amount' => $volumeNeeded,
                'water_amount' => 0,
                'instructions' => 'Use product as is'
            ];
        }

        // Parse dilution ratio (e.g., "1:10" means 1 part product to 10 parts water)
        $ratio = explode(':', $product->dilution_ratio);
        if (count($ratio) !== 2) {
            return [
                'product_amount' => $volumeNeeded,
                'water_amount' => 0,
                'instructions' => 'Invalid dilution ratio'
            ];
        }

        $productParts = (float) $ratio[0];
        $waterParts = (float) $ratio[1];
        $totalParts = $productParts + $waterParts;

        $productAmount = ($volumeNeeded * $productParts) / $totalParts;
        $waterAmount = ($volumeNeeded * $waterParts) / $totalParts;

        return [
            'product_amount' => round($productAmount, 2),
            'water_amount' => round($waterAmount, 2),
            'instructions' => "Mix {$productAmount}ml of product with {$waterAmount}ml of water"
        ];
    }

    /**
     * Get coverage calculation.
     */
    public static function calculateCoverage(CleanProduct $product, float $productAmount): array
    {
        if (!$product->coverage_area) {
            return [
                'coverage' => 0,
                'instructions' => 'Coverage information not available'
            ];
        }

        $coverage = $productAmount * $product->coverage_area;

        return [
            'coverage' => round($coverage, 2),
            'instructions' => "{$productAmount}ml can clean approximately {$coverage}m²"
        ];
    }

    /**
     * Get compatibility warnings.
     */
    public static function getCompatibilityWarnings(CleanProduct $product): array
    {
        $warnings = [];

        // Check incompatible products
        if ($product->incompatible_with) {
            foreach ($product->incompatible_with as $incompatible) {
                $warnings[] = "Do not mix with {$incompatible}";
            }
        }

        // Check pH level warnings
        if ($product->ph_level === 'acidic' && $product->ph_value < 2) {
            $warnings[] = "Strong acid - use with extreme caution";
        }

        if ($product->ph_level === 'alkaline' && $product->ph_value > 12) {
            $warnings[] = "Strong alkali - use with extreme caution";
        }

        // Check ingredient-based warnings
        $hazardousIngredients = $product->ingredients()
            ->where('safety_level', 'hazardous')
            ->get();

        foreach ($hazardousIngredients as $ingredient) {
            if ($ingredient->safety_instructions) {
                $warnings[] = $ingredient->safety_instructions;
            }
        }

        return array_unique($warnings);
    }

    /**
     * Get usage recommendations.
     */
    public static function getUsageRecommendations(CleanProduct $product): array
    {
        $recommendations = [];

        // PPE recommendations
        if ($product->safety_classification !== 'non_hazardous') {
            $recommendations[] = "Wear protective gloves and eyewear";
        }

        // Ventilation recommendations
        if ($product->is_chlorine_free === false || $product->is_ammonia_free === false) {
            $recommendations[] = "Use in well-ventilated area";
        }

        // Surface-specific recommendations
        if ($product->compatible_surfaces) {
            $surfaces = implode(', ', $product->compatible_surfaces);
            $recommendations[] = "Suitable for: {$surfaces}";
        }

        // Dilution recommendations
        if ($product->is_concentrated) {
            $recommendations[] = "Always dilute before use as per instructions";
        }

        // Contact time recommendations
        if ($product->contact_time) {
            $recommendations[] = "Leave on surface for {$product->contact_time} before wiping";
        }

        return $recommendations;
    }

    /**
     * Get product comparison.
     */
    public static function compareProducts(CleanProduct $product1, CleanProduct $product2): array
    {
        return [
            'safety_rating' => [
                'product1' => self::getSafetyRating($product1),
                'product2' => self::getSafetyRating($product2)
            ],
            'eco_score' => [
                'product1' => self::getEcoScore($product1),
                'product2' => self::getEcoScore($product2)
            ],
            'effectiveness' => [
                'product1' => self::getEffectivenessScore($product1),
                'product2' => self::getEffectivenessScore($product2)
            ],
            'features' => [
                'product1' => self::getProductFeatures($product1),
                'product2' => self::getProductFeatures($product2)
            ]
        ];
    }

    /**
     * Get product features summary.
     */
    public static function getProductFeatures(CleanProduct $product): array
    {
        $features = [];

        if ($product->is_eco_friendly) $features[] = 'Eco-friendly';
        if ($product->is_biodegradable) $features[] = 'Biodegradable';
        if ($product->is_antibacterial) $features[] = 'Antibacterial';
        if ($product->is_antiviral) $features[] = 'Antiviral';
        if ($product->is_antifungal) $features[] = 'Antifungal';
        if ($product->is_concentrated) $features[] = 'Concentrated';
        if ($product->is_phosphate_free) $features[] = 'Phosphate-free';
        if ($product->is_chlorine_free) $features[] = 'Chlorine-free';
        if ($product->is_ammonia_free) $features[] = 'Ammonia-free';
        if ($product->is_fragrance_free) $features[] = 'Fragrance-free';

        return $features;
    }
}