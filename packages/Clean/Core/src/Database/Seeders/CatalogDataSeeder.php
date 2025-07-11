<?php

namespace Clean\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanBrand;
use Clean\Core\Models\CleanCategory;
use Clean\Core\Models\CleanProduct;

class CatalogDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedBrands();
        $this->seedCategories();
        $this->seedProducts();
    }
    
    private function seedBrands(): void
    {
        $brands = [
            [
                'name' => 'CLEAN PRO',
                'slug' => 'clean-pro',
                'description' => 'Línea principal de productos de limpieza profesional',
                'country' => 'Colombia',
                'is_eco_friendly' => true,
                'status' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'KLEEN BLUE',
                'slug' => 'kleen-blue',
                'description' => 'Especialistas en tratamiento de piscinas',
                'country' => 'Colombia',
                'is_eco_friendly' => false,
                'status' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'TASK PRO',
                'slug' => 'task-pro',
                'description' => 'Implementos y accesorios profesionales de aseo',
                'country' => 'Colombia',
                'is_eco_friendly' => false,
                'status' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'TASK',
                'slug' => 'task',
                'description' => 'Productos desechables y bolsas para aseo',
                'country' => 'Colombia',
                'is_eco_friendly' => false,
                'status' => true,
                'sort_order' => 4
            ]
        ];
        
        foreach ($brands as $brand) {
            CleanBrand::firstOrCreate(['slug' => $brand['slug']], $brand);
        }
    }
    
    private function seedCategories(): void
    {
        $categories = [
            [
                'name' => 'Químico de limpieza',
                'slug' => 'quimico-limpieza',
                'description' => 'Productos químicos para limpieza y desinfección',
                'usage_area' => 'multi_purpose',
                'surface_type' => 'mixed',
                'status' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Ambientador',
                'slug' => 'ambientador',
                'description' => 'Productos para aromatizar y refrescar ambientes',
                'usage_area' => 'air_freshener',
                'surface_type' => 'mixed',
                'status' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Higiene personal',
                'slug' => 'higiene-personal',
                'description' => 'Productos para el cuidado e higiene personal',
                'usage_area' => 'personal_hygiene',
                'surface_type' => 'soft_surface',
                'status' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Blanqueador',
                'slug' => 'blanqueador',
                'description' => 'Productos blanqueadores y desinfectantes',
                'usage_area' => 'bleaching',
                'surface_type' => 'mixed',
                'status' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Detergente textil',
                'slug' => 'detergente-textil',
                'description' => 'Productos especializados para lavado de textiles',
                'usage_area' => 'laundry',
                'surface_type' => 'soft_surface',
                'status' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Suavizante',
                'slug' => 'suavizante',
                'description' => 'Productos suavizantes para textiles',
                'usage_area' => 'textile_care',
                'surface_type' => 'soft_surface',
                'status' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Disolvente',
                'slug' => 'disolvente',
                'description' => 'Productos disolventes industriales',
                'usage_area' => 'solvent',
                'surface_type' => 'specialized',
                'professional_use' => true,
                'status' => true,
                'sort_order' => 7
            ],
            [
                'name' => 'Tratamiento de piscinas',
                'slug' => 'tratamiento-piscinas',
                'description' => 'Productos especializados para el mantenimiento de piscinas',
                'usage_area' => 'pool_treatment',
                'surface_type' => 'specialized',
                'professional_use' => true,
                'status' => true,
                'sort_order' => 8
            ],
            [
                'name' => 'Implemento de aseo',
                'slug' => 'implemento-aseo',
                'description' => 'Herramientas y accesorios para limpieza',
                'usage_area' => 'cleaning_tools',
                'surface_type' => 'specialized',
                'status' => true,
                'sort_order' => 9
            ],
            [
                'name' => 'Bolsas y desechables',
                'slug' => 'bolsas-desechables',
                'description' => 'Productos desechables para aseo e higiene',
                'usage_area' => 'disposables',
                'surface_type' => 'specialized',
                'status' => true,
                'sort_order' => 10
            ]
        ];
        
        foreach ($categories as $category) {
            CleanCategory::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
    
    private function seedProducts(): void
    {
        // Obtenemos las marcas y categorías
        $cleanPro = CleanBrand::where('slug', 'clean-pro')->first();
        $kleenBlue = CleanBrand::where('slug', 'kleen-blue')->first();
        $taskPro = CleanBrand::where('slug', 'task-pro')->first();
        $task = CleanBrand::where('slug', 'task')->first();
        
        $quimicoLimpieza = CleanCategory::where('slug', 'quimico-limpieza')->first();
        $ambientador = CleanCategory::where('slug', 'ambientador')->first();
        $higienePersonal = CleanCategory::where('slug', 'higiene-personal')->first();
        $blanqueador = CleanCategory::where('slug', 'blanqueador')->first();
        $detergenteTextil = CleanCategory::where('slug', 'detergente-textil')->first();
        $suavizante = CleanCategory::where('slug', 'suavizante')->first();
        $disolvente = CleanCategory::where('slug', 'disolvente')->first();
        $tratamientoPiscinas = CleanCategory::where('slug', 'tratamiento-piscinas')->first();
        $implementoAseo = CleanCategory::where('slug', 'implemento-aseo')->first();
        $bolsasDesechables = CleanCategory::where('slug', 'bolsas-desechables')->first();
        
        $products = [
            [
                'name' => 'Limpiador desinfectante frutas y verduras',
                'clean_brand_id' => $cleanPro?->id,
                'clean_category_id' => $quimicoLimpieza?->id,
                'description' => 'Desinfecta sin alterar sabor, biodegradable, apto contacto alimentos.',
                'benefits' => 'Desinfección segura y efectiva, sin residuos ni alteraciones de sabor.',
                'presentations' => json_encode(['GAL (4L)', '5L', 'Pimpina (20L)']),
                'usage_types' => json_encode(['Doméstico', 'comercial', 'industrial']),
                'product_type' => 'liquid',
                'is_biodegradable' => true,
                'food_contact_safe' => true,
                'no_residue' => true,
                'safety_classification' => 'non_hazardous',
                'catalog_source' => 'excel'
            ],
            [
                'name' => 'Desinfectante con amonio cuaternario',
                'clean_brand_id' => $cleanPro?->id,
                'clean_category_id' => $quimicoLimpieza?->id,
                'description' => 'Fórmula ecológica elimina bacterias, virus y hongos.',
                'benefits' => 'Ambientes higiénicos y seguros, fórmula ecológica.',
                'presentations' => json_encode(['1L', 'GAL (4L)', '5L', 'Pimpina (20L)']),
                'usage_types' => json_encode(['Multisuperficie', 'institucional']),
                'product_type' => 'liquid',
                'is_eco_friendly' => true,
                'is_antibacterial' => true,
                'is_antiviral' => true,
                'is_antifungal' => true,
                'safety_classification' => 'non_hazardous',
                'catalog_source' => 'excel'
            ],
            [
                'name' => 'Ambientador líquido concentrado',
                'clean_brand_id' => $cleanPro?->id,
                'clean_category_id' => $ambientador?->id,
                'description' => 'Fragancia duradera, elimina malos olores, alto rendimiento.',
                'benefits' => 'Neutraliza olores, refresca ambientes con aromas intensos.',
                'presentations' => json_encode(['GAL (4L)', '5L', 'Pimpina (20L)']),
                'available_fragrances' => json_encode([
                    'Manzana Verde', 'Maracuyá', 'Floral', 'Fresa', 'Canela', 
                    'Citronela', 'Chicle', 'Talco', 'Lavanda', 'Brisa Marina', 
                    'Berbena', 'Kiwi', 'Flor de Amoa'
                ]),
                'usage_types' => json_encode(['Doméstico', 'oficinas', 'comercios']),
                'product_type' => 'liquid',
                'is_concentrated' => true,
                'yield_information' => 'Alto rendimiento',
                'catalog_source' => 'excel'
            ],
            [
                'name' => 'Blanqueador clorado 5,5%',
                'clean_brand_id' => $cleanPro?->id,
                'clean_category_id' => $blanqueador?->id,
                'description' => 'Elimina manchas, desinfecta y desodoriza. Apto para ropa y superficies.',
                'benefits' => 'Poder desinfectante, elimina olores y bacterias.',
                'presentations' => json_encode(['GAL (4L)', '5L', 'Pimpina (20L)']),
                'usage_types' => json_encode(['Ropa blanca', 'uso general']),
                'product_type' => 'liquid',
                'concentration_percentage' => '5,5%',
                'is_antibacterial' => true,
                'safety_classification' => 'corrosive',
                'catalog_source' => 'excel'
            ]
        ];
        
        foreach ($products as $product) {
            CleanProduct::create($product);
        }
    }
}