<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class MediasSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'medias';
        $this->filename = base_path() . '/database/seeders/csvs/medias.csv';
    }
}
