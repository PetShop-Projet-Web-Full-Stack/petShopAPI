<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\AnimalSeeder;
use Database\Seeders\PetShopSeeder;
use Database\Seeders\SpeciesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SpeciesSeeder::class,
            RaceSeeder::class,
            PetShopSeeder::class,
            AnimalSeeder::class,
        ]);
    }
}
