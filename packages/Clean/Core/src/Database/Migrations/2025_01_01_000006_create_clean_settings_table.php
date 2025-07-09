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
        Schema::create('clean_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, boolean, integer, json
            $table->string('category')->default('general'); // general, catalog, safety, etc.
            $table->text('description')->nullable();
            $table->boolean('is_editable')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_editable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_settings');
    }
};