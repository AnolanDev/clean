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
        Schema::table('clean_categories', function (Blueprint $table) {
            // Expandir las opciones de usage_area para incluir las nuevas categorías del Excel
            $table->dropColumn('usage_area');
        });
        
        Schema::table('clean_categories', function (Blueprint $table) {
            $table->enum('usage_area', [
                'kitchen', 'bathroom', 'floor', 'glass', 'furniture', 
                'laundry', 'dishwash', 'multi_purpose', 'industrial',
                // Nuevas categorías del catálogo
                'personal_hygiene', 'air_freshener', 'bleaching', 
                'textile_care', 'pool_treatment', 'solvent', 
                'cleaning_tools', 'disposables'
            ])->nullable()->after('metadata');
            
            // Información adicional específica por categoría
            $table->boolean('requires_safety_equipment')->default(false)->after('professional_use');
            $table->json('compatible_materials')->nullable()->after('requires_safety_equipment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clean_categories', function (Blueprint $table) {
            $table->dropColumn(['usage_area', 'requires_safety_equipment', 'compatible_materials']);
        });
        
        Schema::table('clean_categories', function (Blueprint $table) {
            $table->enum('usage_area', [
                'kitchen', 'bathroom', 'floor', 'glass', 'furniture', 
                'laundry', 'dishwash', 'multi_purpose', 'industrial'
            ])->nullable();
        });
    }
};