<?php

declare(strict_types=1);

namespace App\Facades;

use App\Lib\Conversions;
use App\Models\Currency;
use Illuminate\Support\Facades\Facade;

class Money extends Facade
{
    /** @noinspection PhpMissingReturnTypeInspection */
    protected static function getFacadeAccessor()
    {
        return Conversions::class;
    }

    public static function convertToArray(float $value, Currency $currency): array
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return self::convert($value, $currency)->toArray();
    }

    public static function convertToJson(float $value, Currency $currency): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return self::convert($value, $currency)->toJson();
    }
}
