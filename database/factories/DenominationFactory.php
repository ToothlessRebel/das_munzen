<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Denomination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DenominationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Denomination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_id' => Currency::factory()->create()->id,
            'name' => $this->faker->name,
            'value' => $this->faker->randomFloat(3, 0.001),
        ];
    }
}
