<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
}
