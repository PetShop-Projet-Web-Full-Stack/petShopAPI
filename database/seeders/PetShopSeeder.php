<?php
namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class PetShopSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'pet_shops';
        $this->filename = base_path() . '/database/seeders/csvs/pet_shops.csv';
    }
}
