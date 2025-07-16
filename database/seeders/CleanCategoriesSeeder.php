<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanCategory;

class CleanCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Categorías principales (sin parent_id)
            [
                'name' => 'Limpieza General',
                'slug' => 'limpieza-general',
                'description' => 'Productos para limpieza diaria y mantenimiento de superficies',
                'icon' => 'cleaning',
                'parent_id' => null,
                'sort_order' => 1,
                'status' => true,
                'usage_area' => 'domestic',
                'surface_type' => 'multiple',
                'requires_dilution' => false,
                'professional_use' => false
            ],
            [
                'name' => 'Desinfección',
                'slug' => 'desinfeccion',
                'description' => 'Productos especializados en eliminación de microorganismos',
                'icon' => 'shield',
                'parent_id' => null,
                'sort_order' => 2,
                'status' => true,
                'usage_area' => 'healthcare',
                'surface_type' => 'multiple',
                'requires_dilution' => true,
                'professional_use' => true
            ],
            [
                'name' => 'Lavandería',
                'slug' => 'lavanderia',
                'description' => 'Detergentes y productos para lavado de textiles',
                'icon' => 'washing-machine',
                'parent_id' => null,
                'sort_order' => 3,
                'status' => true,
                'usage_area' => 'domestic',
                'surface_type' => 'fabric',
                'requires_dilution' => true,
                'professional_use' => false
            ],
            [
                'name' => 'Cuidado de Pisos',
                'slug' => 'cuidado-pisos',
                'description' => 'Productos especializados para diferentes tipos de pisos',
                'icon' => 'floor',
                'parent_id' => null,
                'sort_order' => 4,
                'status' => true,
                'usage_area' => 'domestic',
                'surface_type' => 'floor',
                'requires_dilution' => true,
                'professional_use' => false
            ],
            [
                'name' => 'Cocina',
                'slug' => 'cocina',
                'description' => 'Productos para limpieza de cocinas y áreas de alimentos',
                'icon' => 'kitchen',
                'parent_id' => null,
                'sort_order' => 5,
                'status' => true,
                'usage_area' => 'kitchen',
                'surface_type' => 'multiple',
                'requires_dilution' => false,
                'professional_use' => false
            ],
            [
                'name' => 'Baño',
                'slug' => 'bano',
                'description' => 'Productos para limpieza y desinfección de baños',
                'icon' => 'bathroom',
                'parent_id' => null,
                'sort_order' => 6,
                'status' => true,
                'usage_area' => 'bathroom',
                'surface_type' => 'ceramic',
                'requires_dilution' => false,
                'professional_use' => false
            ],
            [
                'name' => 'Industria Alimentaria',
                'slug' => 'industria-alimentaria',
                'description' => 'Productos especializados para industria de alimentos',
                'icon' => 'factory',
                'parent_id' => null,
                'sort_order' => 7,
                'status' => true,
                'usage_area' => 'industrial',
                'surface_type' => 'stainless_steel',
                'requires_dilution' => true,
                'professional_use' => true
            ],
            [
                'name' => 'Automotriz',
                'slug' => 'automotriz',
                'description' => 'Productos para limpieza de vehículos',
                'icon' => 'car',
                'parent_id' => null,
                'sort_order' => 8,
                'status' => true,
                'usage_area' => 'automotive',
                'surface_type' => 'multiple',
                'requires_dilution' => true,
                'professional_use' => false
            ]
        ];

        // Crear categorías principales primero
        foreach ($categories as $categoryData) {
            $category = CleanCategory::create($categoryData);
            
            // Crear subcategorías para cada categoría principal
            $this->createSubcategories($category);
        }
    }

    /**
     * Crear subcategorías para cada categoría principal
     */
    private function createSubcategories($parentCategory)
    {
        $subcategories = [];

        switch ($parentCategory->slug) {
            case 'limpieza-general':
                $subcategories = [
                    [
                        'name' => 'Limpiadores Multiuso',
                        'slug' => 'limpiadores-multiuso',
                        'description' => 'Productos para múltiples superficies',
                        'usage_area' => 'domestic',
                        'surface_type' => 'multiple'
                    ],
                    [
                        'name' => 'Limpiadores de Vidrios',
                        'slug' => 'limpiadores-vidrios',
                        'description' => 'Especializados en superficies de vidrio',
                        'usage_area' => 'domestic',
                        'surface_type' => 'glass'
                    ],
                    [
                        'name' => 'Limpiadores de Muebles',
                        'slug' => 'limpiadores-muebles',
                        'description' => 'Para madera y muebles',
                        'usage_area' => 'domestic',
                        'surface_type' => 'wood'
                    ]
                ];
                break;

            case 'desinfeccion':
                $subcategories = [
                    [
                        'name' => 'Desinfectantes Hospitalarios',
                        'slug' => 'desinfectantes-hospitalarios',
                        'description' => 'Grado hospitalario',
                        'usage_area' => 'healthcare',
                        'professional_use' => true
                    ],
                    [
                        'name' => 'Desinfectantes Domésticos',
                        'slug' => 'desinfectantes-domesticos',
                        'description' => 'Para uso en hogares',
                        'usage_area' => 'domestic',
                        'professional_use' => false
                    ],
                    [
                        'name' => 'Sanitizantes de Manos',
                        'slug' => 'sanitizantes-manos',
                        'description' => 'Para higiene personal',
                        'usage_area' => 'personal',
                        'professional_use' => false
                    ]
                ];
                break;

            case 'lavanderia':
                $subcategories = [
                    [
                        'name' => 'Detergente en Polvo',
                        'slug' => 'detergente-polvo',
                        'description' => 'Detergentes tradicionales',
                        'surface_type' => 'fabric'
                    ],
                    [
                        'name' => 'Detergente Líquido',
                        'slug' => 'detergente-liquido',
                        'description' => 'Fórmulas líquidas concentradas',
                        'surface_type' => 'fabric'
                    ],
                    [
                        'name' => 'Suavizantes',
                        'slug' => 'suavizantes',
                        'description' => 'Para suavizar textiles',
                        'surface_type' => 'fabric'
                    ]
                ];
                break;

            case 'cuidado-pisos':
                $subcategories = [
                    [
                        'name' => 'Limpiadores de Cerámica',
                        'slug' => 'limpiadores-ceramica',
                        'description' => 'Para pisos cerámicos',
                        'surface_type' => 'ceramic'
                    ],
                    [
                        'name' => 'Limpiadores de Madera',
                        'slug' => 'limpiadores-madera',
                        'description' => 'Para pisos de madera',
                        'surface_type' => 'wood'
                    ],
                    [
                        'name' => 'Limpiadores de Mármol',
                        'slug' => 'limpiadores-marmol',
                        'description' => 'Para superficies de mármol',
                        'surface_type' => 'marble'
                    ]
                ];
                break;

            case 'cocina':
                $subcategories = [
                    [
                        'name' => 'Desengrasantes',
                        'slug' => 'desengrasantes',
                        'description' => 'Para eliminar grasa',
                        'usage_area' => 'kitchen'
                    ],
                    [
                        'name' => 'Lavavajillas',
                        'slug' => 'lavavajillas',
                        'description' => 'Para lavado de vajilla',
                        'usage_area' => 'kitchen'
                    ],
                    [
                        'name' => 'Limpiadores de Hornos',
                        'slug' => 'limpiadores-hornos',
                        'description' => 'Especializados para hornos',
                        'usage_area' => 'kitchen'
                    ]
                ];
                break;

            case 'bano':
                $subcategories = [
                    [
                        'name' => 'Limpiadores de Inodoros',
                        'slug' => 'limpiadores-inodoros',
                        'description' => 'Para sanitarios',
                        'usage_area' => 'bathroom'
                    ],
                    [
                        'name' => 'Removedores de Sarro',
                        'slug' => 'removedores-sarro',
                        'description' => 'Para eliminar cal y sarro',
                        'usage_area' => 'bathroom'
                    ],
                    [
                        'name' => 'Limpiadores de Azulejos',
                        'slug' => 'limpiadores-azulejos',
                        'description' => 'Para azulejos y juntas',
                        'usage_area' => 'bathroom'
                    ]
                ];
                break;

            case 'industria-alimentaria':
                $subcategories = [
                    [
                        'name' => 'Detergentes Alcalinos',
                        'slug' => 'detergentes-alcalinos',
                        'description' => 'Para industria alimentaria',
                        'professional_use' => true
                    ],
                    [
                        'name' => 'Desinfectantes Food Grade',
                        'slug' => 'desinfectantes-food-grade',
                        'description' => 'Aptos para contacto alimentario',
                        'professional_use' => true
                    ],
                    [
                        'name' => 'Removedores de Proteína',
                        'slug' => 'removedores-proteina',
                        'description' => 'Para residuos proteicos',
                        'professional_use' => true
                    ]
                ];
                break;

            case 'automotriz':
                $subcategories = [
                    [
                        'name' => 'Champú para Autos',
                        'slug' => 'champu-autos',
                        'description' => 'Para lavado exterior',
                        'usage_area' => 'automotive'
                    ],
                    [
                        'name' => 'Limpiadores de Motor',
                        'slug' => 'limpiadores-motor',
                        'description' => 'Para compartimento del motor',
                        'usage_area' => 'automotive'
                    ],
                    [
                        'name' => 'Protectores de Llantas',
                        'slug' => 'protectores-llantas',
                        'description' => 'Para neumáticos',
                        'usage_area' => 'automotive'
                    ]
                ];
                break;
        }

        foreach ($subcategories as $subData) {
            $subData = array_merge([
                'parent_id' => $parentCategory->id,
                'status' => true,
                'sort_order' => 1,
                'requires_dilution' => $parentCategory->requires_dilution,
                'professional_use' => $parentCategory->professional_use
            ], $subData);

            CleanCategory::create($subData);
        }
    }
}
