<?php

namespace Clean\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Clean\Core\Helpers\CleanConfigHelper;

class CleanSettingSeeder extends Seeder
{
    public function run()
    {
        CleanConfigHelper::initializeDefaults();
    }
}