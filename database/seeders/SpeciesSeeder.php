<?php
namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class SpeciesSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'species';
        $this->filename = base_path() . '/database/seeders/csvs/species.csv';
    }
}
