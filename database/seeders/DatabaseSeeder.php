<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\AnimalSeeder;
use Database\Seeders\PetShopSeeder;
use Database\Seeders\SpeciesSeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\MediasSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MediasSeeder::class,
            SpeciesSeeder::class,
            RaceSeeder::class,
            PetShopSeeder::class,
            AnimalSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
