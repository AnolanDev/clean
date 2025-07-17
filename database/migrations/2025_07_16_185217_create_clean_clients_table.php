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
        Schema::create('clean_clients', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_name');
            $table->string('contact_email')->unique();
            $table->string('contact_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('tax_id')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('México');
            $table->string('website')->nullable();
            $table->enum('industry_type', [
                'hospitality', 'healthcare', 'education', 'office', 
                'retail', 'restaurant', 'manufacturing', 'government', 'other'
            ])->default('other');
            $table->enum('client_type', ['corporate', 'small_business', 'government', 'institution'])->default('small_business');
            $table->decimal('credit_limit', 10, 2)->default(0);
            $table->integer('payment_terms')->default(30); // días
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->date('acquisition_date')->nullable();
            $table->date('last_purchase_date')->nullable();
            $table->decimal('total_purchases', 12, 2)->default(0);
            $table->enum('preferred_contact_method', ['email', 'phone', 'whatsapp', 'in_person'])->default('email');
            $table->text('delivery_instructions')->nullable();
            $table->string('account_manager')->nullable();
            $table->enum('risk_level', ['low', 'medium', 'high'])->default('medium');
            $table->json('certifications_required')->nullable();
            $table->enum('cleaning_frequency', ['daily', 'weekly', 'bi_weekly', 'monthly', 'as_needed'])->default('weekly');
            $table->integer('facility_size')->nullable(); // metros cuadrados
            $table->integer('number_of_employees')->nullable();
            $table->timestamps();

            // Índices para mejor rendimiento
            $table->index(['is_active', 'company_name']);
            $table->index(['industry_type', 'client_type']);
            $table->index(['risk_level', 'total_purchases']);
            $table->index(['last_purchase_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_clients');
    }
};
