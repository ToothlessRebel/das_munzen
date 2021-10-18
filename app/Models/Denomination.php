<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Denomination extends Model
{
    use HasFactory;

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopePrimary(Builder $query): Builder
    {
        return $query->where(['value' => 1]);
    }
}
