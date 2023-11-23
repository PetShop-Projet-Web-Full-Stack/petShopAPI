<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class QuestionSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'questions';
        $this->filename = base_path() . '/database/seeders/csvs/questions.csv';
    }
}
