<?php

namespace Clean\Core\Console\Commands;

use Illuminate\Console\Command;
use Clean\Core\Models\CleanBrand;
use Clean\Core\Models\CleanCategory;
use Clean\Core\Models\CleanProduct;
use Illuminate\Support\Str;

class ImportCatalogCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'clean:import-catalog {file} {--format=excel}';

    /**
     * The console command description.
     */
    protected $description = 'Importa productos del catálogo desde un archivo Excel o CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');
        $format = $this->option('format');
        
        if (!file_exists($filePath)) {
            $this->error("El archivo {$filePath} no existe.");
            return 1;
        }
        
        $this->info("Importando catálogo desde: {$filePath}");
        
        try {
            if ($format === 'csv') {
                $this->importFromCSV($filePath);
            } else {
                $this->info("Para importar desde Excel, primero conviértelo a CSV.");
                $this->info("Ejemplo de uso: php artisan clean:import-catalog catalog.csv --format=csv");
                return 1;
            }
            
            $this->info("✅ Importación completada exitosamente.");
        } catch (\Exception $e) {
            $this->error("Error durante la importación: " . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
    
    /**
     * Import data from CSV file.
     */
    private function importFromCSV(string $filePath): void
    {
        $handle = fopen($filePath, 'r');
        
        if (!$handle) {
            throw new \Exception("No se pudo abrir el archivo CSV.");
        }
        
        // Leer la primera línea (encabezados)
        $headers = fgetcsv($handle);
        
        if (!$headers) {
            throw new \Exception("El archivo CSV no tiene encabezados válidos.");
        }
        
        $this->info("Encabezados detectados: " . implode(', ', $headers));
        
        // Mapear encabezados esperados
        $expectedHeaders = [
            'Nombre del producto',
            'Categoría', 
            'Descripción',
            'Presentaciones',
            'Aromas (si aplica)',
            'Beneficios',
            'Marca',
            'Tipo de uso'
        ];
        
        $processed = 0;
        $errors = 0;
        
        $this->withProgressBar(
            $this->getRowCount($filePath) - 1, // -1 porque excluimos encabezados
            function () use ($handle, $headers, &$processed, &$errors) {
                while (($row = fgetcsv($handle)) !== false) {
                    try {
                        $this->processRow($headers, $row);
                        $processed++;
                    } catch (\Exception $e) {
                        $this->newLine();
                        $this->warn("Error en fila {$processed}: " . $e->getMessage());
                        $errors++;
                    }
                }
            }
        );
        
        fclose($handle);
        
        $this->newLine();
        $this->info("Procesados: {$processed} productos");
        if ($errors > 0) {
            $this->warn("Errores: {$errors}");
        }
    }
    
    /**
     * Process a single row from CSV.
     */
    private function processRow(array $headers, array $row): void
    {
        $data = array_combine($headers, $row);
        
        // Buscar o crear marca
        $brandName = trim($data['Marca'] ?? '');
        if (empty($brandName)) {
            throw new \Exception("Marca requerida");
        }
        
        $brand = CleanBrand::firstOrCreate(
            ['slug' => Str::slug($brandName)],
            [
                'name' => $brandName,
                'slug' => Str::slug($brandName),
                'status' => true
            ]
        );
        
        // Buscar o crear categoría
        $categoryName = trim($data['Categoría'] ?? '');
        if (empty($categoryName)) {
            throw new \Exception("Categoría requerida");
        }
        
        $category = CleanCategory::firstOrCreate(
            ['slug' => Str::slug($categoryName)],
            [
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'status' => true
            ]
        );
        
        // Procesar presentaciones
        $presentations = [];
        $presentationsText = trim($data['Presentaciones'] ?? '');
        if (!empty($presentationsText)) {
            $presentations = array_map('trim', explode(',', $presentationsText));
        }
        
        // Procesar aromas
        $fragrances = [];
        $fragrancesText = trim($data['Aromas (si aplica)'] ?? '');
        if (!empty($fragrancesText) && $fragrancesText !== 'N/A') {
            $fragrances = array_map('trim', explode(',', $fragrancesText));
        }
        
        // Procesar tipos de uso
        $usageTypes = [];
        $usageText = trim($data['Tipo de uso'] ?? '');
        if (!empty($usageText)) {
            $usageTypes = array_map('trim', explode(',', $usageText));
        }
        
        // Crear producto
        $productName = trim($data['Nombre del producto'] ?? '');
        if (empty($productName)) {
            throw new \Exception("Nombre del producto requerido");
        }
        
        // Determinar características especiales basadas en nombre y descripción
        $name = strtolower($productName);
        $description = strtolower($data['Descripción'] ?? '');
        
        $characteristics = $this->determineCharacteristics($name, $description);
        
        CleanProduct::updateOrCreate(
            [
                'name' => $productName,
                'clean_brand_id' => $brand->id,
                'clean_category_id' => $category->id
            ],
            [
                'description' => $data['Descripción'] ?? null,
                'benefits' => $data['Beneficios'] ?? null,
                'presentations' => $presentations,
                'available_fragrances' => $fragrances,
                'usage_types' => $usageTypes,
                'catalog_source' => 'excel_import',
                // Características determinadas automáticamente
                'is_eco_friendly' => $characteristics['is_eco_friendly'],
                'is_antibacterial' => $characteristics['is_antibacterial'],
                'is_antiviral' => $characteristics['is_antiviral'],
                'is_biodegradable' => $characteristics['is_biodegradable'],
                'food_contact_safe' => $characteristics['food_contact_safe'],
                'no_residue' => $characteristics['no_residue'],
                'fabric_safe' => $characteristics['fabric_safe'],
                'is_concentrated' => $characteristics['is_concentrated'],
                'product_type' => $characteristics['product_type'],
                'safety_classification' => $characteristics['safety_classification']
            ]
        );
    }
    
    /**
     * Determine product characteristics based on name and description.
     */
    private function determineCharacteristics(string $name, string $description): array
    {
        $characteristics = [
            'is_eco_friendly' => false,
            'is_antibacterial' => false,
            'is_antiviral' => false,
            'is_biodegradable' => false,
            'food_contact_safe' => false,
            'no_residue' => false,
            'fabric_safe' => false,
            'is_concentrated' => false,
            'product_type' => 'liquid',
            'safety_classification' => 'non_hazardous'
        ];
        
        $text = $name . ' ' . $description;
        
        // Eco-friendly indicators
        if (str_contains($text, 'ecológic') || str_contains($text, 'biodegradable') || str_contains($text, 'natural')) {
            $characteristics['is_eco_friendly'] = true;
        }
        
        if (str_contains($text, 'biodegradable')) {
            $characteristics['is_biodegradable'] = true;
        }
        
        // Antibacterial/antiviral
        if (str_contains($text, 'bacteria') || str_contains($text, 'antibacterial') || str_contains($text, 'desinfect')) {
            $characteristics['is_antibacterial'] = true;
        }
        
        if (str_contains($text, 'virus') || str_contains($text, 'antiviral') || str_contains($text, 'desinfect')) {
            $characteristics['is_antiviral'] = true;
        }
        
        // Food contact safe
        if (str_contains($text, 'frutas') || str_contains($text, 'verduras') || str_contains($text, 'alimento')) {
            $characteristics['food_contact_safe'] = true;
        }
        
        // No residue
        if (str_contains($text, 'sin residuo') || str_contains($text, 'no deja residuo')) {
            $characteristics['no_residue'] = true;
        }
        
        // Fabric safe
        if (str_contains($text, 'textil') || str_contains($text, 'ropa') || str_contains($text, 'tela')) {
            $characteristics['fabric_safe'] = true;
        }
        
        // Concentrated
        if (str_contains($text, 'concentrado')) {
            $characteristics['is_concentrated'] = true;
        }
        
        // Product type
        if (str_contains($text, 'spray')) {
            $characteristics['product_type'] = 'spray';
        } elseif (str_contains($text, 'gel')) {
            $characteristics['product_type'] = 'gel';
        } elseif (str_contains($text, 'polvo')) {
            $characteristics['product_type'] = 'powder';
        } elseif (str_contains($text, 'espuma')) {
            $characteristics['product_type'] = 'foam';
        }
        
        // Safety classification
        if (str_contains($text, 'corrosiv') || str_contains($text, 'ácid') || str_contains($text, 'clor')) {
            $characteristics['safety_classification'] = 'corrosive';
        } elseif (str_contains($text, 'irritant')) {
            $characteristics['safety_classification'] = 'irritant';
        }
        
        return $characteristics;
    }
    
    /**
     * Get the number of rows in CSV file.
     */
    private function getRowCount(string $filePath): int
    {
        $handle = fopen($filePath, 'r');
        $count = 0;
        
        while (fgetcsv($handle) !== false) {
            $count++;
        }
        
        fclose($handle);
        return $count;
    }
}