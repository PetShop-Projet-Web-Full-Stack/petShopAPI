<?php
namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class AnimalSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'animals';
        $this->filename = base_path() . '/database/seeders/csvs/animals.csv';
    }
}
