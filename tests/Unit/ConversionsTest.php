<?php /** @noinspection PhpParamsInspection */

declare(strict_types=1);

namespace Tests\Unit;

use App\Lib\Conversions;
use App\Models\Currency;
use Tests\TestCase;

class ConversionsTest extends TestCase
{
    /**
     * @dataProvider minimalExamples
     */
    public function testDasExamples(float $input, array $expected): void
    {
        self::assertEquals(
            $expected,
            (new Conversions())
                ->convert($input, Currency::query()->where(['abbreviation' => 'USD'])->first())
                ->toArray()
        );
    }

    public function testStringInput(): void
    {
        self::assertEquals(
            [
                'silver-dollar' => 0,
                'half-dollar' => 1,
                'quarter' => 0,
                'dime' => 0,
                'nickel' => 0,
                'penny' => 0,
            ],
            (new Conversions())
                ->convert('$0.5', Currency::query()->where(['abbreviation' => 'USD'])->first())
                ->toArray()
        );

        self::assertEquals(
            [
                'silver-dollar' => 0,
                'half-dollar' => 1,
                'quarter' => 0,
                'dime' => 0,
                'nickel' => 0,
                'penny' => 0,
            ],
            (new Conversions())
                ->convert('0.5', Currency::query()->where(['abbreviation' => 'USD'])->first())
                ->toArray()
        );

        self::assertEquals(
            [
                'silver-dollar' => 0,
                'half-dollar' => 1,
                'quarter' => 0,
                'dime' => 0,
                'nickel' => 0,
                'penny' => 0,
            ],
            (new Conversions())->convert('$.5', Currency::query()->where(['abbreviation' => 'USD'])->first())->toArray()
        );

        self::assertEquals(
            [
                'silver-dollar' => 1,
                'half-dollar' => 0,
                'quarter' => 0,
                'dime' => 0,
                'nickel' => 0,
                'penny' => 0,
            ],
            (new Conversions())
                ->convert('1', Currency::query()->where(['abbreviation' => 'USD'])->first())
                ->toArray()
        );
    }

    // These are the minimum acceptable examples.
    public function minimalExamples(): array
    {
        return [
            [
                0.99,
                [
                    'silver-dollar' => 0,
                    'half-dollar' => 1,
                    'quarter' => 1,
                    'dime' => 2,
                    'nickel' => 0,
                    'penny' => 4,
                ],
            ],
            [
                1.56,
                [
                    'silver-dollar' => 1,
                    'half-dollar' => 1,
                    'quarter' => 0,
                    'dime' => 0,
                    'nickel' => 1,
                    'penny' => 1,
                ],
            ],
            [
                12.85,
                [
                    'silver-dollar' => 12,
                    'half-dollar' => 1,
                    'quarter' => 1,
                    'dime' => 1,
                    'nickel' => 0,
                    'penny' => 0,
                ],
            ],
        ];
    }
}
