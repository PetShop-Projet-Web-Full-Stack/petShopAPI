<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    protected $guarded = [];

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

    public function animalsUsers(): HasMany
    {
        return $this->hasMany(AnimalsUser::class);
    }
}
