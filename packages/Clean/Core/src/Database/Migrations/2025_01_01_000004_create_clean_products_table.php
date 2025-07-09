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
        Schema::create('clean_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // FK to products table
            $table->unsignedBigInteger('clean_brand_id')->nullable();
            $table->unsignedBigInteger('clean_category_id')->nullable();
            
            // Información específica del producto de limpieza
            $table->enum('product_type', [
                'liquid', 'powder', 'gel', 'foam', 'spray', 'wipes',
                'concentrate', 'paste', 'granules', 'tablet'
            ])->nullable();
            
            $table->enum('ph_level', [
                'acidic', 'neutral', 'alkaline', 'variable'
            ])->nullable();
            
            $table->decimal('ph_value', 3, 1)->nullable(); // Valor exacto de pH
            
            // Información de uso
            $table->text('usage_instructions')->nullable();
            $table->text('dilution_ratio')->nullable(); // Ej: "1:10 para uso normal"
            $table->integer('coverage_area')->nullable(); // m2 por litro
            $table->text('contact_time')->nullable(); // Tiempo de contacto necesario
            
            // Características especiales
            $table->boolean('is_concentrated')->default(false);
            $table->boolean('is_antibacterial')->default(false);
            $table->boolean('is_antiviral')->default(false);
            $table->boolean('is_antifungal')->default(false);
            $table->boolean('is_eco_friendly')->default(false);
            $table->boolean('is_biodegradable')->default(false);
            $table->boolean('is_phosphate_free')->default(false);
            $table->boolean('is_chlorine_free')->default(false);
            $table->boolean('is_ammonia_free')->default(false);
            $table->boolean('is_fragrance_free')->default(false);
            
            // Información de seguridad
            $table->enum('safety_classification', [
                'non_hazardous', 'irritant', 'corrosive', 'toxic', 'flammable'
            ])->default('non_hazardous');
            
            $table->json('precautions')->nullable(); // Lista de precauciones
            $table->json('first_aid')->nullable(); // Primeros auxilios
            $table->text('storage_conditions')->nullable();
            
            // Certificaciones
            $table->json('certifications')->nullable(); // ISO, ECOLABEL, etc.
            
            // Compatibilidad
            $table->json('compatible_surfaces')->nullable(); // Superficies compatibles
            $table->json('incompatible_with')->nullable(); // Productos incompatibles
            
            // Información técnica
            $table->string('color')->nullable();
            $table->string('fragrance')->nullable();
            $table->decimal('density', 5, 3)->nullable(); // g/ml
            $table->integer('shelf_life_months')->nullable();
            $table->text('packaging_material')->nullable();
            
            $table->timestamps();
            
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('clean_brand_id')->references('id')->on('clean_brands')->onDelete('set null');
            $table->foreign('clean_category_id')->references('id')->on('clean_categories')->onDelete('set null');
            
            $table->index('product_type');
            $table->index('ph_level');
            $table->index(['is_eco_friendly', 'is_biodegradable']);
            $table->index('safety_classification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_products');
    }
};