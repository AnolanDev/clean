<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanBrand;

class CleanBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Procter & Gamble',
                'slug' => 'procter-gamble',
                'description' => 'Líder mundial en productos de consumo, incluye marcas como Dawn, Mr. Clean y Tide',
                'website' => 'https://www.pg.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA Safer Choice', 'Cradle to Cradle'],
                'status' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Unilever',
                'slug' => 'unilever',
                'description' => 'Multinacional con marcas sostenibles como Seventh Generation y OMO',
                'website' => 'https://www.unilever.com',
                'country' => 'Reino Unido',
                'is_eco_friendly' => true,
                'certifications' => ['B Corp', 'Rainforest Alliance', 'RSPO'],
                'status' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Johnson & Johnson',
                'slug' => 'johnson-johnson',
                'description' => 'Empresa farmacéutica y de productos de consumo con enfoque en salud',
                'website' => 'https://www.jnj.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => false,
                'certifications' => ['FDA Approved'],
                'status' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Reckitt Benckiser',
                'slug' => 'reckitt-benckiser',
                'description' => 'Fabricante de productos de higiene y limpieza como Lysol, Dettol y Finish',
                'website' => 'https://www.reckitt.com',
                'country' => 'Reino Unido',
                'is_eco_friendly' => false,
                'certifications' => ['WHO Guidelines'],
                'status' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'SC Johnson',
                'slug' => 'sc-johnson',
                'description' => 'Empresa familiar conocida por Windex, Pledge y productos para el hogar',
                'website' => 'https://www.scjohnson.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA Safer Choice', 'Green Seal'],
                'status' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Clorox',
                'slug' => 'clorox',
                'description' => 'Especialista en productos de limpieza y desinfección con blanqueadores',
                'website' => 'https://www.clorox.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => false,
                'certifications' => ['EPA Registration'],
                'status' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Colgate-Palmolive',
                'slug' => 'colgate-palmolive',
                'description' => 'Fabricante de productos de cuidado personal y limpieza del hogar',
                'website' => 'https://www.colgatepalmolive.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['PETA Certified', 'Rainforest Alliance'],
                'status' => true,
                'sort_order' => 7
            ],
            [
                'name' => 'Henkel',
                'slug' => 'henkel',
                'description' => 'Empresa alemana con marcas como Persil, Bref y productos adhesivos',
                'website' => 'https://www.henkel.com',
                'country' => 'Alemania',
                'is_eco_friendly' => true,
                'certifications' => ['EU Ecolabel', 'Cradle to Cradle'],
                'status' => true,
                'sort_order' => 8
            ],
            [
                'name' => 'Seventh Generation',
                'slug' => 'seventh-generation',
                'description' => 'Marca 100% enfocada en productos de limpieza naturales y sostenibles',
                'website' => 'https://www.seventhgeneration.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA Safer Choice', 'USDA Certified Biobased', 'Leaping Bunny'],
                'status' => true,
                'sort_order' => 9
            ],
            [
                'name' => 'Method',
                'slug' => 'method',
                'description' => 'Marca innovadora de productos de limpieza ecológicos con diseño moderno',
                'website' => 'https://methodhome.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA Safer Choice', 'Cradle to Cradle', 'B Corp'],
                'status' => true,
                'sort_order' => 10
            ],
            [
                'name' => 'Ecover',
                'slug' => 'ecover',
                'description' => 'Pionera en productos de limpieza ecológicos desde 1980',
                'website' => 'https://www.ecover.com',
                'country' => 'Bélgica',
                'is_eco_friendly' => true,
                'certifications' => ['EU Ecolabel', 'Nordic Swan', 'Vegan Society'],
                'status' => true,
                'sort_order' => 11
            ],
            [
                'name' => 'Mrs. Meyer\'s Clean Day',
                'slug' => 'mrs-meyers-clean-day',
                'description' => 'Productos de limpieza aromáticos inspirados en jardín con ingredientes naturales',
                'website' => 'https://www.mrsmeyers.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA Safer Choice', 'Leaping Bunny'],
                'status' => true,
                'sort_order' => 12
            ],
            [
                'name' => 'Simple Green',
                'slug' => 'simple-green',
                'description' => 'Marca especializada en limpiadores concentrados biodegradables',
                'website' => 'https://simplegreen.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA Safer Choice', 'Green Seal'],
                'status' => true,
                'sort_order' => 13
            ],
            [
                'name' => 'Diversey',
                'slug' => 'diversey',
                'description' => 'Líder global en productos de limpieza profesional e institucional',
                'website' => 'https://www.diversey.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA DfE', 'Green Seal', 'EcoLogo'],
                'status' => true,
                'sort_order' => 14
            ],
            [
                'name' => 'Ecolab',
                'slug' => 'ecolab',
                'description' => 'Empresa especializada en soluciones de agua, higiene y energía',
                'website' => 'https://www.ecolab.com',
                'country' => 'Estados Unidos',
                'is_eco_friendly' => true,
                'certifications' => ['EPA WaterSense', 'Green Seal', 'ENERGY STAR'],
                'status' => true,
                'sort_order' => 15
            ]
        ];

        foreach ($brands as $brandData) {
            CleanBrand::create($brandData);
        }
    }
}
