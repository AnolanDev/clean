<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clean_products', function (Blueprint $table) {
            // Información básica del producto (que está en el Excel)
            $table->string('name')->after('id'); // Nombre del producto
            $table->text('description')->nullable()->after('name'); // Descripción
            $table->text('benefits')->nullable()->after('description'); // Beneficios
            
            // Presentaciones/envases
            $table->json('presentations')->nullable()->after('benefits'); // ["1L", "GAL (4L)", "5L", "Pimpina (20L)"]
            
            // Aromas (múltiples por producto)
            $table->json('available_fragrances')->nullable()->after('fragrance'); // ["Manzana Verde", "Maracuyá", "Floral"]
            
            // Tipo de uso del producto
            $table->json('usage_types')->nullable()->after('compatible_surfaces'); // ["Doméstico", "comercial", "industrial"]
            
            // Campo para identificar el origen del catálogo
            $table->string('catalog_source')->default('excel')->after('usage_types');
            
            // Información adicional que puede venir del Excel
            $table->boolean('is_concentrated_formula')->default(false)->after('is_concentrated');
            $table->string('concentration_percentage')->nullable()->after('is_concentrated_formula'); // "5,5%" para blanqueador
            
            // Campos específicos por tipo de producto
            $table->boolean('food_contact_safe')->default(false)->after('is_fragrance_free'); // Para frutas y verduras
            $table->boolean('no_residue')->default(false)->after('food_contact_safe'); // Sin residuos
            $table->boolean('fabric_safe')->default(false)->after('no_residue'); // Seguro para textiles
            
            // Información de rendimiento
            $table->text('yield_information')->nullable()->after('coverage_area'); // Alto rendimiento, etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clean_products', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'description', 
                'benefits',
                'presentations',
                'available_fragrances',
                'usage_types',
                'catalog_source',
                'is_concentrated_formula',
                'concentration_percentage',
                'food_contact_safe',
                'no_residue',
                'fabric_safe',
                'yield_information'
            ]);
        });
    }
};