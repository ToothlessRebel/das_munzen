<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Denomination;
use Illuminate\Database\Seeder;

class UsdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usd = Currency::query()
            ->create([
                'name' => 'United States Dollar',
                'symbol' => '$',
                'abbreviation' => 'USD',
            ]);

        Denomination::query()
            ->create([
                'currency_id' => $usd->id,
                'name' => 'silver-dollar',
                'value' => 1,
            ]);

        Denomination::query()
            ->create([
                'currency_id' => $usd->id,
                'name' => 'half-dollar',
                'value' => 0.5,
            ]);

        Denomination::query()
            ->create([
                'currency_id' => $usd->id,
                'name' => 'quarter',
                'value' => 0.25,
            ]);

        Denomination::query()
            ->create([
                'currency_id' => $usd->id,
                'name' => 'dime',
                'value' => 0.10,
            ]);

        Denomination::query()
            ->create([
                'currency_id' => $usd->id,
                'name' => 'nickel',
                'value' => 0.05,
            ]);

        Denomination::query()
            ->create([
                'currency_id' => $usd->id,
                'name' => 'penny',
                'value' => 0.01,
            ]);
    }
}
