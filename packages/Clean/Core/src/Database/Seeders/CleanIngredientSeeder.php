<?php

namespace Clean\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanIngredient;

class CleanIngredientSeeder extends Seeder
{
    public function run()
    {
        $ingredients = [
            // Surfactantes
            [
                'name' => 'Laurilsulfato de sodio',
                'chemical_name' => 'Sodium lauryl sulfate',
                'cas_number' => '151-21-3',
                'description' => 'Tensioactivo aniónico con excelente poder espumante',
                'type' => 'surfactant',
                'safety_level' => 'medium',
                'hazard_symbols' => ['Xi'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Evitar contacto con ojos y piel',
                'concentration_min' => 5.0,
                'concentration_max' => 15.0
            ],
            [
                'name' => 'Cocamidopropil betaína',
                'chemical_name' => 'Cocamidopropyl betaine',
                'cas_number' => '61789-40-0',
                'description' => 'Tensioactivo anfótero suave derivado del coco',
                'type' => 'surfactant',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto seguro para uso doméstico',
                'concentration_min' => 2.0,
                'concentration_max' => 10.0
            ],
            [
                'name' => 'Alquil poliglucósido',
                'chemical_name' => 'Alkyl polyglucoside',
                'cas_number' => '110615-47-9',
                'description' => 'Tensioactivo no iónico de origen vegetal',
                'type' => 'surfactant',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Tensioactivo ecológico y biodegradable',
                'concentration_min' => 3.0,
                'concentration_max' => 12.0
            ],

            // Desinfectantes
            [
                'name' => 'Cloruro de benzalconio',
                'chemical_name' => 'Benzalkonium chloride',
                'cas_number' => '8001-54-5',
                'description' => 'Compuesto de amonio cuaternario con propiedades antimicrobianas',
                'type' => 'disinfectant',
                'safety_level' => 'medium',
                'hazard_symbols' => ['Xn', 'Xi'],
                'is_natural' => false,
                'is_biodegradable' => false,
                'safety_instructions' => 'Usar guantes y evitar inhalación',
                'concentration_min' => 0.1,
                'concentration_max' => 2.0
            ],
            [
                'name' => 'Alcohol etílico',
                'chemical_name' => 'Ethanol',
                'cas_number' => '64-17-5',
                'description' => 'Alcohol desinfectante de amplio espectro',
                'type' => 'disinfectant',
                'safety_level' => 'medium',
                'hazard_symbols' => ['F'],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Mantener alejado de fuentes de ignición',
                'concentration_min' => 60.0,
                'concentration_max' => 85.0
            ],
            [
                'name' => 'Peróxido de hidrógeno',
                'chemical_name' => 'Hydrogen peroxide',
                'cas_number' => '7722-84-1',
                'description' => 'Agente oxidante con propiedades desinfectantes',
                'type' => 'disinfectant',
                'safety_level' => 'high',
                'hazard_symbols' => ['O', 'Xi'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Usar protección ocular y guantes',
                'concentration_min' => 0.5,
                'concentration_max' => 3.0
            ],

            // Ácidos
            [
                'name' => 'Ácido cítrico',
                'chemical_name' => 'Citric acid',
                'cas_number' => '77-92-9',
                'description' => 'Ácido natural con propiedades antical',
                'type' => 'ph_adjuster',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto seguro de origen natural',
                'concentration_min' => 1.0,
                'concentration_max' => 10.0
            ],
            [
                'name' => 'Ácido clorhídrico',
                'chemical_name' => 'Hydrochloric acid',
                'cas_number' => '7647-01-0',
                'description' => 'Ácido fuerte para eliminación de cal',
                'type' => 'ph_adjuster',
                'safety_level' => 'hazardous',
                'hazard_symbols' => ['C'],
                'is_natural' => false,
                'is_biodegradable' => false,
                'safety_instructions' => 'Usar protección completa, solo uso profesional',
                'concentration_min' => 0.5,
                'concentration_max' => 5.0
            ],

            // Enzimas
            [
                'name' => 'Proteasa',
                'chemical_name' => 'Protease enzyme',
                'cas_number' => '9014-01-1',
                'description' => 'Enzima que descompone proteínas',
                'type' => 'enzyme',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Enzima natural biodegradable',
                'concentration_min' => 0.1,
                'concentration_max' => 1.0
            ],
            [
                'name' => 'Lipasa',
                'chemical_name' => 'Lipase enzyme',
                'cas_number' => '9001-62-1',
                'description' => 'Enzima que descompone grasas',
                'type' => 'enzyme',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Enzima natural para eliminación de grasas',
                'concentration_min' => 0.1,
                'concentration_max' => 1.0
            ],

            // Fragancias
            [
                'name' => 'Limoneno',
                'chemical_name' => 'Limonene',
                'cas_number' => '5989-27-5',
                'description' => 'Fragancia natural de cítricos',
                'type' => 'fragrance',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Fragancia natural de cítricos',
                'concentration_min' => 0.1,
                'concentration_max' => 2.0
            ],
            [
                'name' => 'Linalol',
                'chemical_name' => 'Linalool',
                'cas_number' => '78-70-6',
                'description' => 'Fragancia floral natural',
                'type' => 'fragrance',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Fragancia natural de lavanda',
                'concentration_min' => 0.1,
                'concentration_max' => 1.5
            ],

            // Conservantes
            [
                'name' => 'Metilisotiazolinona',
                'chemical_name' => 'Methylisothiazolinone',
                'cas_number' => '2682-20-4',
                'description' => 'Conservante antimicrobiano',
                'type' => 'preservative',
                'safety_level' => 'medium',
                'hazard_symbols' => ['Xi', 'N'],
                'is_natural' => false,
                'is_biodegradable' => false,
                'safety_instructions' => 'Posible sensibilizante cutáneo',
                'concentration_min' => 0.01,
                'concentration_max' => 0.1
            ],
            [
                'name' => 'Benzoato de sodio',
                'chemical_name' => 'Sodium benzoate',
                'cas_number' => '532-32-1',
                'description' => 'Conservante natural',
                'type' => 'preservative',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Conservante seguro de uso alimentario',
                'concentration_min' => 0.1,
                'concentration_max' => 1.0
            ]
        ];

        foreach ($ingredients as $ingredient) {
            CleanIngredient::create($ingredient);
        }
    }
}