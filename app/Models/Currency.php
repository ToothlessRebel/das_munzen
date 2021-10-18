<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Currency
 *
 * @property string $symbol
 * @property string $abbreviation
 * @property string $name
 */
class Currency extends Model
{
    use HasFactory;

    public function denominations(): HasMany
    {
        return $this->hasMany(Denomination::class);
    }

    public function primaryDenomination(): Denomination
    {
        return $this->denominations()->primary()->first();
    }
}
