<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetShop extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function animals()
    {
        return $this->hasMany(Animal::class, 'pet_shops_id');
    }
}
