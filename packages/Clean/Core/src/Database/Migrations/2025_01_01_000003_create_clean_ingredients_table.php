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
        Schema::create('clean_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('chemical_name')->nullable();
            $table->string('cas_number')->nullable(); // Chemical Abstracts Service number
            $table->text('description')->nullable();
            $table->enum('type', [
                'surfactant', 'disinfectant', 'fragrance', 'preservative',
                'ph_adjuster', 'thickener', 'colorant', 'enzyme', 'other'
            ]);
            $table->enum('safety_level', ['low', 'medium', 'high', 'hazardous'])->default('low');
            $table->json('hazard_symbols')->nullable(); // Pictogramas de peligro
            $table->boolean('is_natural')->default(false);
            $table->boolean('is_biodegradable')->default(false);
            $table->text('safety_instructions')->nullable();
            $table->decimal('concentration_min', 5, 2)->nullable(); // % mínimo
            $table->decimal('concentration_max', 5, 2)->nullable(); // % máximo
            $table->timestamps();
            
            $table->index('type');
            $table->index('safety_level');
            $table->index(['is_natural', 'is_biodegradable']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_ingredients');
    }
};