<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanProduct;
use Clean\Core\Models\CleanBrand;
use Clean\Core\Models\CleanCategory;
use Clean\Core\Models\CleanIngredient;

class CleanProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener referencias de marcas y categorías
        $brands = CleanBrand::all()->keyBy('slug');
        $categories = CleanCategory::all()->keyBy('slug');
        $ingredients = CleanIngredient::all()->keyBy('name');

        $products = [
            // Productos de Procter & Gamble
            [
                'name' => 'Dawn Ultra Dishwashing Liquid',
                'clean_brand_id' => $brands['procter-gamble']->id,
                'clean_category_id' => $categories['lavavajillas']->id,
                'description' => 'Detergente concentrado para vajilla con poder desengrasante superior',
                'benefits' => 'Elimina grasa difícil, suave con las manos, biodegradable',
                'presentations' => ['532ml', '828ml', '1.41L', '2.66L'],
                'available_fragrances' => ['Original', 'Apple Blossom', 'Lavender', 'Fresh Mint'],
                'usage_types' => ['manual'],
                'catalog_source' => 'P&G Official',
                'is_concentrated_formula' => true,
                'concentration_percentage' => '30.0',
                'food_contact_safe' => true,
                'no_residue' => true,
                'fabric_safe' => false,
                'yield_information' => '532ml rinde hasta 10,600 platos',
                'product_type' => 'detergent',
                'ph_level' => 'neutral',
                'ph_value' => 7.2,
                'usage_instructions' => 'Aplicar directamente sobre esponja húmeda. Para grasa difícil, aplicar directamente sobre la superficie.',
                'dilution_ratio' => '1:100 para lavado regular',
                'coverage_area' => null,
                'contact_time' => '30 segundos',
                'is_concentrated' => true,
                'is_antibacterial' => false,
                'is_antiviral' => false,
                'is_antifungal' => false,
                'is_eco_friendly' => true,
                'is_biodegradable' => true,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => true,
                'is_fragrance_free' => false,
                'safety_classification' => 'non_hazardous',
                'precautions' => ['Evitar contacto con ojos', 'Mantener fuera del alcance de niños'],
                'first_aid' => ['Ojos: Enjuagar con agua abundante', 'Ingestión: No inducir vómito, buscar atención médica'],
                'storage_conditions' => 'Almacenar en lugar fresco y seco',
                'certifications' => ['EPA Safer Choice'],
                'compatible_surfaces' => ['vajilla', 'vidrio', 'plástico', 'acero inoxidable'],
                'incompatible_with' => ['blanqueadores', 'amoníaco'],
                'color' => 'azul',
                'fragrance' => 'cítrico fresco',
                'density' => 1.020,
                'shelf_life_months' => 24,
                'packaging_material' => 'botella plástica reciclable',
                'ingredients_data' => [
                    ['name' => 'Sodium Lauryl Sulfate', 'concentration' => 15.0, 'is_active' => true, 'function' => 'surfactant'],
                    ['name' => 'Sodium Laureth Sulfate', 'concentration' => 8.0, 'is_active' => true, 'function' => 'surfactant'],
                    ['name' => 'Cocamidopropyl Betaine', 'concentration' => 5.0, 'is_active' => false, 'function' => 'foam booster'],
                    ['name' => 'Citric Acid', 'concentration' => 2.0, 'is_active' => false, 'function' => 'pH adjuster'],
                    ['name' => 'Phenoxyethanol', 'concentration' => 0.5, 'is_active' => false, 'function' => 'preservative']
                ]
            ],
            [
                'name' => 'Mr. Clean Multi-Surface Cleaner',
                'clean_brand_id' => $brands['procter-gamble']->id,
                'clean_category_id' => $categories['limpiadores-multiuso']->id,
                'description' => 'Limpiador multiuso que corta grasa y suciedad en múltiples superficies',
                'benefits' => 'Limpieza profunda, sin residuos, aroma duradero',
                'presentations' => ['828ml', '1.33L', '3.78L'],
                'available_fragrances' => ['Summer Citrus', 'Lavender', 'Gain Original'],
                'usage_types' => ['spray', 'dilutable'],
                'catalog_source' => 'P&G Official',
                'is_concentrated_formula' => false,
                'food_contact_safe' => false,
                'no_residue' => true,
                'fabric_safe' => false,
                'product_type' => 'cleaner',
                'ph_level' => 'alkaline',
                'ph_value' => 9.5,
                'usage_instructions' => 'Rociar sobre la superficie, limpiar con paño húmedo. Para suciedad difícil, dejar actuar 30 segundos.',
                'dilution_ratio' => '1:10 para limpieza general',
                'coverage_area' => 50,
                'contact_time' => '30 segundos',
                'is_concentrated' => false,
                'is_antibacterial' => false,
                'is_antiviral' => false,
                'is_antifungal' => false,
                'is_eco_friendly' => false,
                'is_biodegradable' => true,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => false,
                'is_fragrance_free' => false,
                'safety_classification' => 'non_hazardous',
                'precautions' => ['Usar en áreas ventiladas', 'Evitar contacto con ojos'],
                'first_aid' => ['Ojos: Enjuagar inmediatamente con agua'],
                'storage_conditions' => 'Almacenar a temperatura ambiente',
                'certifications' => [],
                'compatible_surfaces' => ['vidrio', 'madera sellada', 'plástico', 'cerámica', 'metal'],
                'incompatible_with' => ['mármol sin sellar', 'piedra natural'],
                'color' => 'amarillo',
                'fragrance' => 'cítrico',
                'density' => 1.010,
                'shelf_life_months' => 36,
                'packaging_material' => 'botella plástica',
                'ingredients_data' => [
                    ['name' => 'Isopropyl Alcohol', 'concentration' => 25.0, 'is_active' => true, 'function' => 'solvent'],
                    ['name' => 'Sodium Lauryl Sulfate', 'concentration' => 5.0, 'is_active' => true, 'function' => 'surfactant'],
                    ['name' => 'Limonene', 'concentration' => 1.0, 'is_active' => false, 'function' => 'fragrance'],
                    ['name' => 'FD&C Blue No. 1', 'concentration' => 0.01, 'is_active' => false, 'function' => 'colorant']
                ]
            ],

            // Productos de Unilever/Seventh Generation
            [
                'name' => 'Seventh Generation Disinfecting Multi-Surface Cleaner',
                'clean_brand_id' => $brands['seventh-generation']->id,
                'clean_category_id' => $categories['desinfectantes-domesticos']->id,
                'description' => 'Desinfectante multiuso de origen vegetal que elimina 99.99% de gérmenes',
                'benefits' => 'Ingredientes de origen vegetal, sin químicos tóxicos, efectivo contra virus y bacterias',
                'presentations' => ['828ml', '1.89L'],
                'available_fragrances' => ['Lemongrass Citrus', 'Garden Mint'],
                'usage_types' => ['spray', 'wipe'],
                'catalog_source' => 'Seventh Generation Official',
                'is_concentrated_formula' => false,
                'food_contact_safe' => true,
                'no_residue' => true,
                'fabric_safe' => false,
                'product_type' => 'disinfectant',
                'ph_level' => 'neutral',
                'ph_value' => 7.0,
                'usage_instructions' => 'Rociar hasta mojar superficie. Dejar actuar 30 segundos para desinfectar. Limpiar con paño.',
                'contact_time' => '30 segundos',
                'is_concentrated' => false,
                'is_antibacterial' => true,
                'is_antiviral' => true,
                'is_antifungal' => false,
                'is_eco_friendly' => true,
                'is_biodegradable' => true,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => true,
                'is_fragrance_free' => false,
                'safety_classification' => 'non_hazardous',
                'precautions' => ['No mezclar con otros productos'],
                'first_aid' => ['Contacto con ojos: Enjuagar con agua'],
                'storage_conditions' => 'Almacenar en lugar fresco',
                'certifications' => ['EPA Safer Choice', 'USDA Certified Biobased'],
                'compatible_surfaces' => ['vidrio', 'metal', 'plástico', 'madera sellada'],
                'incompatible_with' => ['superficies porosas sin sellar'],
                'color' => 'transparente',
                'fragrance' => 'herbal natural',
                'density' => 0.998,
                'shelf_life_months' => 24,
                'packaging_material' => 'botella plástica reciclada',
                'ingredients_data' => [
                    ['name' => 'Ethanol', 'concentration' => 58.0, 'is_active' => true, 'function' => 'disinfectant'],
                    ['name' => 'Citric Acid', 'concentration' => 3.0, 'is_active' => false, 'function' => 'pH adjuster'],
                    ['name' => 'Limonene', 'concentration' => 1.5, 'is_active' => false, 'function' => 'fragrance'],
                    ['name' => 'Linalool', 'concentration' => 0.8, 'is_active' => false, 'function' => 'fragrance']
                ]
            ],

            // Productos de Reckitt Benckiser
            [
                'name' => 'Lysol Disinfectant Spray',
                'clean_brand_id' => $brands['reckitt-benckiser']->id,
                'clean_category_id' => $categories['desinfectantes-domesticos']->id,
                'description' => 'Aerosol desinfectante que elimina 99.9% de virus y bacterias en superficies',
                'benefits' => 'Acción rápida, elimina virus de gripe, COVID-19, y bacterias comunes',
                'presentations' => ['354ml', '539ml', '2 x 354ml pack'],
                'available_fragrances' => ['Original', 'Crisp Linen', 'Country Scent'],
                'usage_types' => ['aerosol'],
                'catalog_source' => 'Reckitt Official',
                'is_concentrated_formula' => true,
                'food_contact_safe' => false,
                'no_residue' => false,
                'fabric_safe' => true,
                'product_type' => 'disinfectant',
                'ph_level' => 'neutral',
                'ph_value' => 7.5,
                'usage_instructions' => 'Rociar hasta mojar superficie. Para desinfectar dejar actuar 30 segundos antes de limpiar.',
                'contact_time' => '30 segundos para virus, 10 segundos para bacterias',
                'is_concentrated' => true,
                'is_antibacterial' => true,
                'is_antiviral' => true,
                'is_antifungal' => true,
                'is_eco_friendly' => false,
                'is_biodegradable' => false,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => true,
                'is_fragrance_free' => false,
                'safety_classification' => 'moderately_hazardous',
                'precautions' => ['Usar en áreas ventiladas', 'No inhalar directamente', 'Evitar contacto con ojos'],
                'first_aid' => ['Inhalación: Llevar a aire fresco', 'Ojos: Enjuagar 15 minutos'],
                'storage_conditions' => 'No exponer a temperaturas superiores a 49°C',
                'certifications' => ['EPA Registration'],
                'compatible_surfaces' => ['metal', 'plástico', 'vidrio', 'tela', 'madera'],
                'incompatible_with' => ['productos con blanqueador'],
                'color' => 'transparente',
                'fragrance' => 'fresco limpio',
                'shelf_life_months' => 24,
                'packaging_material' => 'lata aerosol',
                'ingredients_data' => [
                    ['name' => 'Ethanol', 'concentration' => 79.0, 'is_active' => true, 'function' => 'disinfectant'],
                    ['name' => 'Isopropyl Alcohol', 'concentration' => 15.0, 'is_active' => true, 'function' => 'disinfectant'],
                    ['name' => 'Limonene', 'concentration' => 2.0, 'is_active' => false, 'function' => 'fragrance']
                ]
            ],

            // Productos de Clorox
            [
                'name' => 'Clorox Regular Bleach',
                'clean_brand_id' => $brands['clorox']->id,
                'clean_category_id' => $categories['desinfectantes-domesticos']->id,
                'description' => 'Blanqueador líquido concentrado para desinfección y blanqueado',
                'benefits' => 'Blanquea, desinfecta, remueve manchas difíciles',
                'presentations' => ['946ml', '1.89L', '3.78L'],
                'available_fragrances' => ['Regular'],
                'usage_types' => ['dilutable'],
                'catalog_source' => 'Clorox Official',
                'is_concentrated_formula' => true,
                'concentration_percentage' => '6.0',
                'food_contact_safe' => false,
                'no_residue' => false,
                'fabric_safe' => true,
                'product_type' => 'bleach',
                'ph_level' => 'alkaline',
                'ph_value' => 11.4,
                'usage_instructions' => 'SIEMPRE diluir antes de usar. Para desinfección: 1 parte de producto en 9 partes de agua.',
                'dilution_ratio' => '1:9 para desinfección, 1:15 para blanqueado',
                'contact_time' => '1 minuto para desinfección, 5 minutos para blanqueado',
                'is_concentrated' => true,
                'is_antibacterial' => true,
                'is_antiviral' => true,
                'is_antifungal' => true,
                'is_eco_friendly' => false,
                'is_biodegradable' => false,
                'is_phosphate_free' => true,
                'is_chlorine_free' => false,
                'is_ammonia_free' => true,
                'is_fragrance_free' => true,
                'safety_classification' => 'hazardous',
                'precautions' => ['NUNCA mezclar con amoníaco o ácidos', 'Usar guantes', 'Asegurar ventilación'],
                'first_aid' => ['Contacto con piel: Enjuagar inmediatamente', 'Inhalación: Aire fresco inmediatamente'],
                'storage_conditions' => 'Lugar fresco, seco, fuera del alcance de niños',
                'certifications' => ['EPA Registration'],
                'compatible_surfaces' => ['cerámica', 'vidrio', 'metal no poroso', 'ropa blanca'],
                'incompatible_with' => ['amoníaco', 'ácidos', 'alcohol', 'peróxido de hidrógeno'],
                'color' => 'transparente amarillento',
                'fragrance' => 'cloro',
                'density' => 1.084,
                'shelf_life_months' => 12,
                'packaging_material' => 'botella plástica opaca',
                'ingredients_data' => [
                    ['name' => 'Sodium Hypochlorite', 'concentration' => 6.0, 'is_active' => true, 'function' => 'active'],
                    ['name' => 'Sodium Hydroxide', 'concentration' => 0.5, 'is_active' => false, 'function' => 'pH stabilizer'],
                    ['name' => 'Sodium Chloride', 'concentration' => 2.0, 'is_active' => false, 'function' => 'stabilizer']
                ]
            ],

            // Productos de SC Johnson
            [
                'name' => 'Windex Original Glass Cleaner',
                'clean_brand_id' => $brands['sc-johnson']->id,
                'clean_category_id' => $categories['limpiadores-vidrios']->id,
                'description' => 'Limpiador de vidrios que deja superficies brillantes sin rayas',
                'benefits' => 'Sin rayas, secado rápido, brillo cristalino',
                'presentations' => ['765ml', '1.89L'],
                'available_fragrances' => ['Original'],
                'usage_types' => ['spray'],
                'catalog_source' => 'SC Johnson Official',
                'is_concentrated_formula' => false,
                'food_contact_safe' => false,
                'no_residue' => true,
                'fabric_safe' => false,
                'product_type' => 'glass_cleaner',
                'ph_level' => 'alkaline',
                'ph_value' => 10.5,
                'usage_instructions' => 'Rociar sobre superficie. Limpiar con paño sin pelusa o papel.',
                'contact_time' => 'inmediato',
                'is_concentrated' => false,
                'is_antibacterial' => false,
                'is_antiviral' => false,
                'is_antifungal' => false,
                'is_eco_friendly' => true,
                'is_biodegradable' => true,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => false,
                'is_fragrance_free' => false,
                'safety_classification' => 'non_hazardous',
                'precautions' => ['Evitar contacto con ojos'],
                'first_aid' => ['Ojos: Enjuagar con agua abundante'],
                'storage_conditions' => 'Temperatura ambiente',
                'certifications' => ['EPA Safer Choice'],
                'compatible_surfaces' => ['vidrio', 'espejos', 'plástico transparente'],
                'incompatible_with' => ['superficies calientes'],
                'color' => 'azul claro',
                'fragrance' => 'fresco',
                'density' => 0.992,
                'shelf_life_months' => 36,
                'packaging_material' => 'botella plástica con spray',
                'ingredients_data' => [
                    ['name' => 'Isopropyl Alcohol', 'concentration' => 35.0, 'is_active' => true, 'function' => 'solvent'],
                    ['name' => 'Sodium Lauryl Sulfate', 'concentration' => 2.0, 'is_active' => false, 'function' => 'surfactant'],
                    ['name' => 'FD&C Blue No. 1', 'concentration' => 0.005, 'is_active' => false, 'function' => 'colorant']
                ]
            ],

            // Productos de Method
            [
                'name' => 'Method All-Purpose Cleaner French Lavender',
                'clean_brand_id' => $brands['method']->id,
                'clean_category_id' => $categories['limpiadores-multiuso']->id,
                'description' => 'Limpiador multiuso con fragrancia natural de lavanda francesa',
                'benefits' => 'Ingredientes de origen vegetal, biodegradable, botella reciclada',
                'presentations' => ['828ml'],
                'available_fragrances' => ['French Lavender', 'Pink Grapefruit', 'Cucumber'],
                'usage_types' => ['spray'],
                'catalog_source' => 'Method Official',
                'is_concentrated_formula' => false,
                'food_contact_safe' => true,
                'no_residue' => true,
                'fabric_safe' => false,
                'product_type' => 'cleaner',
                'ph_level' => 'neutral',
                'ph_value' => 7.8,
                'usage_instructions' => 'Rociar, limpiar, sonreír. Para suciedad difícil, dejar actuar unos segundos.',
                'contact_time' => '10 segundos',
                'is_concentrated' => false,
                'is_antibacterial' => false,
                'is_antiviral' => false,
                'is_antifungal' => false,
                'is_eco_friendly' => true,
                'is_biodegradable' => true,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => true,
                'is_fragrance_free' => false,
                'safety_classification' => 'non_hazardous',
                'precautions' => ['Evitar contacto con ojos'],
                'first_aid' => ['Ojos: Enjuagar con agua'],
                'storage_conditions' => 'Temperatura ambiente',
                'certifications' => ['EPA Safer Choice', 'Cradle to Cradle'],
                'compatible_surfaces' => ['vidrio', 'metal', 'cerámica', 'plástico', 'madera sellada'],
                'incompatible_with' => ['mármol sin sellar'],
                'color' => 'púrpura claro',
                'fragrance' => 'lavanda francesa',
                'density' => 1.005,
                'shelf_life_months' => 24,
                'packaging_material' => 'botella 100% plástico reciclado',
                'ingredients_data' => [
                    ['name' => 'Sodium Lauryl Sulfate', 'concentration' => 8.0, 'is_active' => true, 'function' => 'surfactant'],
                    ['name' => 'Citric Acid', 'concentration' => 1.5, 'is_active' => false, 'function' => 'pH adjuster'],
                    ['name' => 'Linalool', 'concentration' => 0.9, 'is_active' => false, 'function' => 'fragrance'],
                    ['name' => 'Limonene', 'concentration' => 0.3, 'is_active' => false, 'function' => 'fragrance']
                ]
            ],

            // Productos de Henkel
            [
                'name' => 'Persil ProClean Liquid Laundry Detergent',
                'clean_brand_id' => $brands['henkel']->id,
                'clean_category_id' => $categories['detergente-liquido']->id,
                'description' => 'Detergente líquido concentrado con tecnología de enzimas avanzadas',
                'benefits' => 'Elimina manchas difíciles, protege colores, fórmula concentrada',
                'presentations' => ['1.47L', '2.21L', '4.43L'],
                'available_fragrances' => ['Original', 'Intense Fresh', 'Clean Fresh'],
                'usage_types' => ['washing_machine'],
                'catalog_source' => 'Henkel Official',
                'is_concentrated_formula' => true,
                'concentration_percentage' => '85.0',
                'food_contact_safe' => false,
                'no_residue' => true,
                'fabric_safe' => true,
                'yield_information' => '1.47L rinde hasta 48 cargas',
                'product_type' => 'detergent',
                'ph_level' => 'alkaline',
                'ph_value' => 8.2,
                'usage_instructions' => 'Usar 30ml para carga regular, 45ml para manchas difíciles. No aplicar directamente sobre tela.',
                'dilution_ratio' => 'Se diluye automáticamente en la lavadora',
                'contact_time' => 'ciclo completo de lavado',
                'is_concentrated' => true,
                'is_antibacterial' => false,
                'is_antiviral' => false,
                'is_antifungal' => false,
                'is_eco_friendly' => true,
                'is_biodegradable' => true,
                'is_phosphate_free' => true,
                'is_chlorine_free' => true,
                'is_ammonia_free' => true,
                'is_fragrance_free' => false,
                'safety_classification' => 'non_hazardous',
                'precautions' => ['Mantener fuera del alcance de niños', 'Evitar contacto con ojos'],
                'first_aid' => ['Ojos: Enjuagar inmediatamente', 'Ingestión: Dar agua, no inducir vómito'],
                'storage_conditions' => 'Lugar fresco y seco',
                'certifications' => ['EU Ecolabel'],
                'compatible_surfaces' => ['algodón', 'poliéster', 'mezclas', 'colores'],
                'incompatible_with' => ['blanqueadores', 'suavizantes en la misma carga'],
                'color' => 'azul oscuro',
                'fragrance' => 'fresco limpio',
                'density' => 1.035,
                'shelf_life_months' => 30,
                'packaging_material' => 'botella plástica reciclable',
                'ingredients_data' => [
                    ['name' => 'Sodium Lauryl Sulfate', 'concentration' => 25.0, 'is_active' => true, 'function' => 'surfactant'],
                    ['name' => 'Sodium Laureth Sulfate', 'concentration' => 15.0, 'is_active' => true, 'function' => 'surfactant'],
                    ['name' => 'Citric Acid', 'concentration' => 3.0, 'is_active' => false, 'function' => 'pH adjuster'],
                    ['name' => 'Phenoxyethanol', 'concentration' => 0.8, 'is_active' => false, 'function' => 'preservative'],
                    ['name' => 'Limonene', 'concentration' => 1.2, 'is_active' => false, 'function' => 'fragrance']
                ]
            ]
        ];

        foreach ($products as $productData) {
            // Extraer datos de ingredientes
            $ingredientsData = $productData['ingredients_data'] ?? [];
            unset($productData['ingredients_data']);

            // Crear el producto
            $product = CleanProduct::create($productData);

            // Asociar ingredientes con información del pivot
            foreach ($ingredientsData as $ingredientInfo) {
                $ingredient = $ingredients[$ingredientInfo['name']] ?? null;
                if ($ingredient) {
                    $product->ingredients()->attach($ingredient->id, [
                        'concentration' => $ingredientInfo['concentration'],
                        'is_active_ingredient' => $ingredientInfo['is_active'],
                        'function_in_product' => $ingredientInfo['function']
                    ]);
                }
            }
        }
    }
}
