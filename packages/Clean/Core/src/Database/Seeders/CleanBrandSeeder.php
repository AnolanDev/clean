<?php

namespace Clean\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanBrand;

class CleanBrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            [
                'name' => 'EcoClean',
                'slug' => 'ecoclean',
                'description' => 'Productos de limpieza ecológicos y biodegradables',
                'country' => 'España',
                'is_eco_friendly' => true,
                'certifications' => ['ECOLABEL', 'ISO 14001'],
                'status' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'CleanMaster',
                'slug' => 'cleanmaster',
                'description' => 'Productos profesionales de limpieza industrial',
                'country' => 'Alemania',
                'is_eco_friendly' => false,
                'certifications' => ['ISO 9001'],
                'status' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'GreenHome',
                'slug' => 'greenhome',
                'description' => 'Limpieza natural para el hogar',
                'country' => 'Francia',
                'is_eco_friendly' => true,
                'certifications' => ['ECOLABEL', 'BIO'],
                'status' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'ProClean',
                'slug' => 'proclean',
                'description' => 'Soluciones de limpieza profesional',
                'country' => 'Italia',
                'is_eco_friendly' => false,
                'certifications' => ['ISO 9001', 'HACCP'],
                'status' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'NaturalClean',
                'slug' => 'naturalclean',
                'description' => 'Productos 100% naturales y seguros',
                'country' => 'Suecia',
                'is_eco_friendly' => true,
                'certifications' => ['NORDIC SWAN', 'CRADLE TO CRADLE'],
                'status' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'MaxClean',
                'slug' => 'maxclean',
                'description' => 'Limpieza potente para uso intensivo',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => false,
                'certifications' => ['EPA CERTIFIED'],
                'status' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($brands as $brand) {
            CleanBrand::create($brand);
        }
    }
}