<?php

namespace Clean\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanCategory;

class CleanCategorySeeder extends Seeder
{
    public function run()
    {
        // Categorías principales
        $categories = [
            [
                'name' => 'Limpieza de Cocina',
                'slug' => 'limpieza-cocina',
                'description' => 'Productos especializados para la limpieza de cocinas',
                'usage_area' => 'kitchen',
                'surface_type' => 'mixed',
                'requires_dilution' => false,
                'professional_use' => false,
                'status' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Limpieza de Baños',
                'slug' => 'limpieza-banos',
                'description' => 'Productos para higiene y limpieza de baños',
                'usage_area' => 'bathroom',
                'surface_type' => 'mixed',
                'requires_dilution' => false,
                'professional_use' => false,
                'status' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Limpieza de Suelos',
                'slug' => 'limpieza-suelos',
                'description' => 'Productos para todo tipo de suelos',
                'usage_area' => 'floor',
                'surface_type' => 'hard_surface',
                'requires_dilution' => true,
                'professional_use' => false,
                'status' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Limpieza de Cristales',
                'slug' => 'limpieza-cristales',
                'description' => 'Productos para cristales y superficies transparentes',
                'usage_area' => 'glass',
                'surface_type' => 'specialized',
                'requires_dilution' => false,
                'professional_use' => false,
                'status' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Desinfectantes',
                'slug' => 'desinfectantes',
                'description' => 'Productos desinfectantes y antimicrobianos',
                'usage_area' => 'multi_purpose',
                'surface_type' => 'mixed',
                'requires_dilution' => true,
                'professional_use' => false,
                'status' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Limpieza Industrial',
                'slug' => 'limpieza-industrial',
                'description' => 'Productos para uso profesional e industrial',
                'usage_area' => 'industrial',
                'surface_type' => 'mixed',
                'requires_dilution' => true,
                'professional_use' => true,
                'status' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $categoryData) {
            $category = CleanCategory::create($categoryData);

            // Crear subcategorías
            $this->createSubcategories($category);
        }
    }

    private function createSubcategories($parentCategory)
    {
        $subcategories = [];

        switch ($parentCategory->slug) {
            case 'limpieza-cocina':
                $subcategories = [
                    [
                        'name' => 'Desengrasantes',
                        'slug' => 'desengrasantes-cocina',
                        'description' => 'Eliminan grasa y residuos de cocina',
                        'usage_area' => 'kitchen',
                        'surface_type' => 'hard_surface'
                    ],
                    [
                        'name' => 'Lavavajillas',
                        'slug' => 'lavavajillas',
                        'description' => 'Productos para lavar vajilla',
                        'usage_area' => 'dishwash',
                        'surface_type' => 'specialized'
                    ]
                ];
                break;

            case 'limpieza-banos':
                $subcategories = [
                    [
                        'name' => 'Antical',
                        'slug' => 'antical',
                        'description' => 'Elimina cal y residuos de jabón',
                        'usage_area' => 'bathroom',
                        'surface_type' => 'hard_surface'
                    ],
                    [
                        'name' => 'Desatascadores',
                        'slug' => 'desatascadores',
                        'description' => 'Productos para desatascar tuberías',
                        'usage_area' => 'bathroom',
                        'surface_type' => 'specialized'
                    ]
                ];
                break;

            case 'limpieza-suelos':
                $subcategories = [
                    [
                        'name' => 'Fregasuelos Universal',
                        'slug' => 'fregasuelos-universal',
                        'description' => 'Para todo tipo de suelos',
                        'usage_area' => 'floor',
                        'surface_type' => 'hard_surface'
                    ],
                    [
                        'name' => 'Abrillantadores',
                        'slug' => 'abrillantadores',
                        'description' => 'Dan brillo y protegen el suelo',
                        'usage_area' => 'floor',
                        'surface_type' => 'hard_surface'
                    ]
                ];
                break;
        }

        foreach ($subcategories as $subcategoryData) {
            $subcategoryData['parent_id'] = $parentCategory->id;
            $subcategoryData['requires_dilution'] = $subcategoryData['requires_dilution'] ?? false;
            $subcategoryData['professional_use'] = false;
            $subcategoryData['status'] = true;
            $subcategoryData['sort_order'] = 1;

            CleanCategory::create($subcategoryData);
        }
    }
}