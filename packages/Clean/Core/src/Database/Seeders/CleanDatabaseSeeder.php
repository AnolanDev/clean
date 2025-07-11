<?php

namespace Clean\Core\Database\Seeders;

use Illuminate\Database\Seeder;

class CleanDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CleanBrandSeeder::class,
            CleanCategorySeeder::class,
            CleanIngredientSeeder::class,
            CleanSettingSeeder::class,
            CatalogDataSeeder::class,
        ]);
    }
}