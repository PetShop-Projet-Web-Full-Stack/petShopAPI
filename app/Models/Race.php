<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function species()
    {
        return $this->hasMany(Species::class);
    }
}
