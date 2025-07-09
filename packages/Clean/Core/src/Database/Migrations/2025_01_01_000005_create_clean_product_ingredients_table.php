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
        Schema::create('clean_product_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clean_product_id');
            $table->unsignedBigInteger('clean_ingredient_id');
            $table->decimal('concentration', 5, 2)->nullable(); // Porcentaje
            $table->boolean('is_active_ingredient')->default(false);
            $table->text('function_in_product')->nullable(); // Función específica
            $table->timestamps();
            
            $table->foreign('clean_product_id')->references('id')->on('clean_products')->onDelete('cascade');
            $table->foreign('clean_ingredient_id')->references('id')->on('clean_ingredients')->onDelete('cascade');
            
            $table->unique(['clean_product_id', 'clean_ingredient_id'], 'clean_product_ingredient_unique');
            $table->index('is_active_ingredient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_product_ingredients');
    }
};