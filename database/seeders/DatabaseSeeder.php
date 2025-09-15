<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TemplateCategorySeeder::class,
            TemplateSeeder::class,
            UserSeeder::class,
        ]);
    }
}
