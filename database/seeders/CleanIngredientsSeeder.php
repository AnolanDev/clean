<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Clean\Core\Models\CleanIngredient;

class CleanIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            // Surfactantes (Tensioactivos)
            [
                'name' => 'Sodium Lauryl Sulfate',
                'chemical_name' => 'Dodecyl sodium sulfate',
                'cas_number' => '151-21-3',
                'description' => 'Surfactante aniónico ampliamente utilizado en detergentes y productos de limpieza',
                'type' => 'surfactant',
                'safety_level' => 'medium',
                'hazard_symbols' => ['irritant'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Evitar contacto con ojos y piel. Usar guantes protectores.',
                'concentration_min' => 0.5,
                'concentration_max' => 15.0,
            ],
            [
                'name' => 'Sodium Laureth Sulfate',
                'chemical_name' => 'Sodium lauryl ether sulfate',
                'cas_number' => '68891-38-3',
                'description' => 'Surfactante suave, menos irritante que el SLS',
                'type' => 'surfactant',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto seguro para uso doméstico normal.',
                'concentration_min' => 1.0,
                'concentration_max' => 20.0,
            ],
            [
                'name' => 'Cocamidopropyl Betaine',
                'chemical_name' => 'Coconut oil amidopropyl betaine',
                'cas_number' => '61789-40-0',
                'description' => 'Surfactante anfótero derivado del aceite de coco, muy suave',
                'type' => 'surfactant',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto de origen natural, seguro para uso regular.',
                'concentration_min' => 0.5,
                'concentration_max' => 10.0,
            ],

            // Solventes
            [
                'name' => 'Isopropyl Alcohol',
                'chemical_name' => '2-Propanol',
                'cas_number' => '67-63-0',
                'description' => 'Alcohol isopropílico, excelente desengrasante y desinfectante',
                'type' => 'solvent',
                'safety_level' => 'medium',
                'hazard_symbols' => ['flammable', 'irritant'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Mantener alejado del fuego. Usar en áreas ventiladas.',
                'concentration_min' => 5.0,
                'concentration_max' => 70.0,
            ],
            [
                'name' => 'Ethanol',
                'chemical_name' => 'Ethyl alcohol',
                'cas_number' => '64-17-5',
                'description' => 'Alcohol etílico, desinfectante y solvente natural',
                'type' => 'solvent',
                'safety_level' => 'low',
                'hazard_symbols' => ['flammable'],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Mantener alejado de fuentes de ignición.',
                'concentration_min' => 10.0,
                'concentration_max' => 95.0,
            ],

            // Conservantes
            [
                'name' => 'Phenoxyethanol',
                'chemical_name' => '2-Phenoxyethanol',
                'cas_number' => '122-99-6',
                'description' => 'Conservante antimicrobiano de amplio espectro',
                'type' => 'preservative',
                'safety_level' => 'medium',
                'hazard_symbols' => ['irritant'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Evitar contacto con ojos y mucosas.',
                'concentration_min' => 0.1,
                'concentration_max' => 1.0,
            ],
            [
                'name' => 'Sodium Benzoate',
                'chemical_name' => 'Sodium benzoate',
                'cas_number' => '532-32-1',
                'description' => 'Conservante natural derivado del ácido benzoico',
                'type' => 'preservative',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto seguro para uso alimentario y cosmético.',
                'concentration_min' => 0.05,
                'concentration_max' => 0.5,
            ],

            // Fragancias
            [
                'name' => 'Limonene',
                'chemical_name' => 'D-Limonene',
                'cas_number' => '5989-27-5',
                'description' => 'Terpeno natural extraído de cítricos, fragancia cítrica',
                'type' => 'fragrance',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Puede causar alergias en personas sensibles.',
                'concentration_min' => 0.1,
                'concentration_max' => 2.0,
            ],
            [
                'name' => 'Linalool',
                'chemical_name' => '3,7-dimethylocta-1,6-dien-3-ol',
                'cas_number' => '78-70-6',
                'description' => 'Alcohol terpénico natural, fragancia floral',
                'type' => 'fragrance',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Posible alérgeno, declarar en etiqueta.',
                'concentration_min' => 0.05,
                'concentration_max' => 1.0,
            ],

            // Colorantes
            [
                'name' => 'FD&C Blue No. 1',
                'chemical_name' => 'Brilliant Blue FCF',
                'cas_number' => '3844-45-9',
                'description' => 'Colorante azul sintético aprobado por FDA',
                'type' => 'colorant',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => false,
                'is_biodegradable' => false,
                'safety_instructions' => 'Colorante alimentario seguro.',
                'concentration_min' => 0.001,
                'concentration_max' => 0.1,
            ],

            // Buffers (Reguladores de pH)
            [
                'name' => 'Citric Acid',
                'chemical_name' => '2-hydroxypropane-1,2,3-tricarboxylic acid',
                'cas_number' => '77-92-9',
                'description' => 'Ácido orgánico natural, regulador de pH y quelante',
                'type' => 'buffer',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto alimentario seguro.',
                'concentration_min' => 0.1,
                'concentration_max' => 5.0,
            ],
            [
                'name' => 'Sodium Hydroxide',
                'chemical_name' => 'Caustic soda',
                'cas_number' => '1310-73-2',
                'description' => 'Hidróxido de sodio, base fuerte para ajuste de pH',
                'type' => 'buffer',
                'safety_level' => 'hazardous',
                'hazard_symbols' => ['corrosive', 'irritant'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'MUY PELIGROSO. Usar equipo de protección completo. Evitar contacto con piel y ojos.',
                'concentration_min' => 0.01,
                'concentration_max' => 2.0,
            ],

            // Espesantes
            [
                'name' => 'Xanthan Gum',
                'chemical_name' => 'Xanthan gum',
                'cas_number' => '11138-66-2',
                'description' => 'Polisacárido natural, espesante y estabilizador',
                'type' => 'thickener',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto natural seguro.',
                'concentration_min' => 0.1,
                'concentration_max' => 2.0,
            ],
            [
                'name' => 'Sodium Chloride',
                'chemical_name' => 'Salt',
                'cas_number' => '7647-14-5',
                'description' => 'Sal común, espesante para surfactantes',
                'type' => 'thickener',
                'safety_level' => 'low',
                'hazard_symbols' => [],
                'is_natural' => true,
                'is_biodegradable' => true,
                'safety_instructions' => 'Producto alimentario seguro.',
                'concentration_min' => 0.5,
                'concentration_max' => 10.0,
            ],

            // Principios activos
            [
                'name' => 'Hydrogen Peroxide',
                'chemical_name' => 'Hydrogen peroxide',
                'cas_number' => '7722-84-1',
                'description' => 'Peróxido de hidrógeno, agente blanqueador y desinfectante',
                'type' => 'active',
                'safety_level' => 'high',
                'hazard_symbols' => ['oxidizing', 'corrosive'],
                'is_natural' => false,
                'is_biodegradable' => true,
                'safety_instructions' => 'Usar guantes y gafas protectoras. Mantener alejado del calor.',
                'concentration_min' => 0.5,
                'concentration_max' => 12.0,
            ],
            [
                'name' => 'Sodium Hypochlorite',
                'chemical_name' => 'Sodium hypochlorite',
                'cas_number' => '7681-52-9',
                'description' => 'Hipoclorito de sodio, blanqueador y desinfectante potente',
                'type' => 'active',
                'safety_level' => 'hazardous',
                'hazard_symbols' => ['corrosive', 'oxidizing', 'environmental'],
                'is_natural' => false,
                'is_biodegradable' => false,
                'safety_instructions' => 'PELIGROSO. No mezclar con otros productos. Usar en áreas ventiladas.',
                'concentration_min' => 0.1,
                'concentration_max' => 6.0,
            ],
        ];

        foreach ($ingredients as $ingredientData) {
            CleanIngredient::create($ingredientData);
        }
    }
}
