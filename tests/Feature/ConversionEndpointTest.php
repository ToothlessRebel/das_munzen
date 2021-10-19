<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Facades\Money;
use App\Models\Currency;
use Tests\TestCase;
use Tests\WithUSD;

class ConversionEndpointTest extends TestCase
{
    use WithUSD;

    public function testConversion(): void
    {
        /** @var Currency $usd */
        $usd = Currency::query()->where(['abbreviation'=>'USD'])->firstOrFail();
        $target = $this->faker->randomFloat();
        $this->get("/api/convert/USD?value={$target}")
            ->assertJson(Money::convertToArray($target, $usd));
    }
}
