<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Denomination
 *
 * @property string $name
 * @property float $value
 * @property-read Currency $currency
 */
class Denomination extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'float',
    ];

    protected static function booted()
    {
        static::addGlobalScope('descendingValue', function (Builder $query) {
            $query->orderBy('value', 'DESC');
        });
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopePrimary(Builder $query): Builder
    {
        return $query->where(['value' => 1]);
    }
}
