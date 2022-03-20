<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SlidersTableSeedert::class,
            TagSeeder::class,
            SectionSeeder::class,
            SectionProductSeeder::class,
            ProductSeeder::class,
            VarietySeeder::class,
            ReviewSeeder::class,
            StatusSeeder::class
        ]);
    }
}
