<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Facades\Money;
use App\Models\Currency;
use App\Models\Denomination;
use Tests\TestCase;

class ConversionFacadeTest extends TestCase
{
    public function testConversionToArray(): void
    {
        /** @var Currency $currency */
        $currency = Currency::factory()->create();
        Denomination::factory()->count(5)->create([
            'currency_id' => $currency->id,
        ]);
        $target = $this->faker->randomFloat();

        $conversion = Money::convertToArray($target, $currency);
        self::assertIsArray($conversion);
        self::assertCount($currency->denominations()->count(), $conversion);
    }

    public function testConversionToJson(): void
    {
        /** @var Currency $currency */
        $currency = Currency::factory()->create();
        Denomination::factory()->count(5)->create([
            'currency_id' => $currency->id,
        ]);
        $target = $this->faker->randomFloat();

        $conversion = json_decode(Money::convertToJson($target, $currency), true);
        self::assertCount($currency->denominations()->count(), $conversion);
    }
}
