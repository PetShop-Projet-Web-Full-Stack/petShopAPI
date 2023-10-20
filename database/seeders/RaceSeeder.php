<?php
namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class RaceSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'races';
        $this->filename = base_path() . '/database/seeders/csvs/races.csv';
    }
}
