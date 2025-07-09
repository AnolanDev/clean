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
        Schema::create('clean_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->json('metadata')->nullable();
            
            // Campos específicos para productos de limpieza
            $table->enum('usage_area', [
                'kitchen', 'bathroom', 'floor', 'glass', 'furniture', 
                'laundry', 'dishwash', 'multi_purpose', 'industrial'
            ])->nullable();
            $table->enum('surface_type', [
                'hard_surface', 'soft_surface', 'mixed', 'specialized'
            ])->nullable();
            $table->boolean('requires_dilution')->default(false);
            $table->boolean('professional_use')->default(false);
            
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('clean_categories')->onDelete('cascade');
            $table->index(['status', 'sort_order']);
            $table->index('usage_area');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_categories');
    }
};