<?php

namespace App\Models;

use App\Models\PetShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function petShop(): BelongsTo
    {
        return $this->belongsTo(PetShop::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}
