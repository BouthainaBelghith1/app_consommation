<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorieSeeder::class,
            UserSeeder::class,
            ChatSeeder::class,
            LocalSeeder::class,
            RegionSeeder::class,
            CompteurSeeder::class,
            FactureSeeder::class,
            NotificationSeeder::class,
            
        ]);
    }
}
