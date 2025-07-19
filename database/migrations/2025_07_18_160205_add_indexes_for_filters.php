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
        // Índices para la tabla clean_ingredients
        Schema::table('clean_ingredients', function (Blueprint $table) {
            $table->index('type', 'idx_ingredients_type');
            $table->index('safety_level', 'idx_ingredients_safety_level');
            $table->index('is_natural', 'idx_ingredients_is_natural');
            $table->index('is_biodegradable', 'idx_ingredients_is_biodegradable');
            $table->index(['type', 'safety_level'], 'idx_ingredients_type_safety');
            $table->index(['is_natural', 'is_biodegradable'], 'idx_ingredients_natural_biodegradable');
            $table->index(['created_at', 'updated_at'], 'idx_ingredients_dates');
        });

        // Índices para la tabla clean_products
        Schema::table('clean_products', function (Blueprint $table) {
            $table->index('clean_brand_id', 'idx_products_brand_id');
            $table->index('clean_category_id', 'idx_products_category_id');
            $table->index('safety_classification', 'idx_products_safety_classification');
            $table->index('product_type', 'idx_products_product_type');
            $table->index('is_eco_friendly', 'idx_products_is_eco_friendly');
            $table->index('is_antibacterial', 'idx_products_is_antibacterial');
            $table->index('is_antiviral', 'idx_products_is_antiviral');
            $table->index('is_biodegradable', 'idx_products_is_biodegradable');
            $table->index('food_contact_safe', 'idx_products_food_contact_safe');
            $table->index('no_residue', 'idx_products_no_residue');
            $table->index('fabric_safe', 'idx_products_fabric_safe');
            $table->index(['clean_brand_id', 'clean_category_id'], 'idx_products_brand_category');
            $table->index(['is_eco_friendly', 'is_antibacterial'], 'idx_products_eco_antibacterial');
            $table->index(['safety_classification', 'product_type'], 'idx_products_safety_type');
            $table->index(['created_at', 'updated_at'], 'idx_products_dates');
        });

        // Índices para la tabla clean_categories
        Schema::table('clean_categories', function (Blueprint $table) {
            $table->index('parent_id', 'idx_categories_parent_id');
            $table->index('usage_area', 'idx_categories_usage_area');
            $table->index('surface_type', 'idx_categories_surface_type');
            $table->index('status', 'idx_categories_status');
            $table->index('professional_use', 'idx_categories_professional_use');
            $table->index('sort_order', 'idx_categories_sort_order');
            $table->index(['parent_id', 'status'], 'idx_categories_parent_status');
            $table->index(['usage_area', 'surface_type'], 'idx_categories_usage_surface');
            $table->index(['status', 'professional_use'], 'idx_categories_status_professional');
            $table->index(['created_at', 'updated_at'], 'idx_categories_dates');
        });

        // Índices para la tabla clean_brands
        Schema::table('clean_brands', function (Blueprint $table) {
            $table->index('status', 'idx_brands_status');
            $table->index('country', 'idx_brands_country');
            $table->index('is_eco_friendly', 'idx_brands_is_eco_friendly');
            $table->index(['status', 'country'], 'idx_brands_status_country');
            $table->index(['status', 'is_eco_friendly'], 'idx_brands_status_eco');
            $table->index(['created_at', 'updated_at'], 'idx_brands_dates');
        });

        // Índices para la tabla clean_clients
        Schema::table('clean_clients', function (Blueprint $table) {
            $table->index('industry_type', 'idx_clients_industry_type');
            $table->index('client_type', 'idx_clients_client_type');
            $table->index('risk_level', 'idx_clients_risk_level');
            $table->index('is_active', 'idx_clients_is_active');
            $table->index('total_purchases', 'idx_clients_total_purchases');
            $table->index('last_purchase_date', 'idx_clients_last_purchase_date');
            $table->index(['industry_type', 'client_type'], 'idx_clients_industry_client_type');
            $table->index(['is_active', 'risk_level'], 'idx_clients_active_risk');
            $table->index(['total_purchases', 'last_purchase_date'], 'idx_clients_purchases_date');
            $table->index(['created_at', 'updated_at'], 'idx_clients_dates');
        });

        // Índices para búsquedas de texto (solo si no existen ya)
        if (!Schema::hasColumn('clean_ingredients', 'name_search_index')) {
            Schema::table('clean_ingredients', function (Blueprint $table) {
                $table->index('name', 'idx_ingredients_name_search');
                $table->index('chemical_name', 'idx_ingredients_chemical_name_search');
                $table->index('cas_number', 'idx_ingredients_cas_number_search');
            });
        }

        if (!Schema::hasColumn('clean_products', 'name_search_index')) {
            Schema::table('clean_products', function (Blueprint $table) {
                $table->index('name', 'idx_products_name_search');
            });
        }

        if (!Schema::hasColumn('clean_categories', 'name_search_index')) {
            Schema::table('clean_categories', function (Blueprint $table) {
                $table->index('name', 'idx_categories_name_search');
                $table->index('slug', 'idx_categories_slug_search');
            });
        }

        if (!Schema::hasColumn('clean_brands', 'name_search_index')) {
            Schema::table('clean_brands', function (Blueprint $table) {
                $table->index('name', 'idx_brands_name_search');
            });
        }

        if (!Schema::hasColumn('clean_clients', 'name_search_index')) {
            Schema::table('clean_clients', function (Blueprint $table) {
                $table->index('company_name', 'idx_clients_company_name_search');
                $table->index('contact_name', 'idx_clients_contact_name_search');
                $table->index('contact_email', 'idx_clients_contact_email_search');
                $table->index('tax_id', 'idx_clients_tax_id_search');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover índices de clean_ingredients
        Schema::table('clean_ingredients', function (Blueprint $table) {
            $table->dropIndex('idx_ingredients_type');
            $table->dropIndex('idx_ingredients_safety_level');
            $table->dropIndex('idx_ingredients_is_natural');
            $table->dropIndex('idx_ingredients_is_biodegradable');
            $table->dropIndex('idx_ingredients_type_safety');
            $table->dropIndex('idx_ingredients_natural_biodegradable');
            $table->dropIndex('idx_ingredients_dates');
            $table->dropIndex('idx_ingredients_name_search');
            $table->dropIndex('idx_ingredients_chemical_name_search');
            $table->dropIndex('idx_ingredients_cas_number_search');
        });

        // Remover índices de clean_products
        Schema::table('clean_products', function (Blueprint $table) {
            $table->dropIndex('idx_products_brand_id');
            $table->dropIndex('idx_products_category_id');
            $table->dropIndex('idx_products_safety_classification');
            $table->dropIndex('idx_products_product_type');
            $table->dropIndex('idx_products_is_eco_friendly');
            $table->dropIndex('idx_products_is_antibacterial');
            $table->dropIndex('idx_products_is_antiviral');
            $table->dropIndex('idx_products_is_biodegradable');
            $table->dropIndex('idx_products_food_contact_safe');
            $table->dropIndex('idx_products_no_residue');
            $table->dropIndex('idx_products_fabric_safe');
            $table->dropIndex('idx_products_brand_category');
            $table->dropIndex('idx_products_eco_antibacterial');
            $table->dropIndex('idx_products_safety_type');
            $table->dropIndex('idx_products_dates');
            $table->dropIndex('idx_products_name_search');
        });

        // Remover índices de clean_categories
        Schema::table('clean_categories', function (Blueprint $table) {
            $table->dropIndex('idx_categories_parent_id');
            $table->dropIndex('idx_categories_usage_area');
            $table->dropIndex('idx_categories_surface_type');
            $table->dropIndex('idx_categories_status');
            $table->dropIndex('idx_categories_professional_use');
            $table->dropIndex('idx_categories_sort_order');
            $table->dropIndex('idx_categories_parent_status');
            $table->dropIndex('idx_categories_usage_surface');
            $table->dropIndex('idx_categories_status_professional');
            $table->dropIndex('idx_categories_dates');
            $table->dropIndex('idx_categories_name_search');
            $table->dropIndex('idx_categories_slug_search');
        });

        // Remover índices de clean_brands
        Schema::table('clean_brands', function (Blueprint $table) {
            $table->dropIndex('idx_brands_status');
            $table->dropIndex('idx_brands_country');
            $table->dropIndex('idx_brands_is_eco_friendly');
            $table->dropIndex('idx_brands_status_country');
            $table->dropIndex('idx_brands_status_eco');
            $table->dropIndex('idx_brands_dates');
            $table->dropIndex('idx_brands_name_search');
        });

        // Remover índices de clean_clients
        Schema::table('clean_clients', function (Blueprint $table) {
            $table->dropIndex('idx_clients_industry_type');
            $table->dropIndex('idx_clients_client_type');
            $table->dropIndex('idx_clients_risk_level');
            $table->dropIndex('idx_clients_is_active');
            $table->dropIndex('idx_clients_total_purchases');
            $table->dropIndex('idx_clients_last_purchase_date');
            $table->dropIndex('idx_clients_industry_client_type');
            $table->dropIndex('idx_clients_active_risk');
            $table->dropIndex('idx_clients_purchases_date');
            $table->dropIndex('idx_clients_dates');
            $table->dropIndex('idx_clients_company_name_search');
            $table->dropIndex('idx_clients_contact_name_search');
            $table->dropIndex('idx_clients_contact_email_search');
            $table->dropIndex('idx_clients_tax_id_search');
        });
    }
};