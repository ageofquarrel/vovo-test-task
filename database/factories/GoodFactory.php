<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Good>
 */
class GoodFactory extends Factory
{
    protected $model = Good::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->words(fake()->numberBetween(2, 4), true)) 
                . ' ' . fake()->numerify('###'),
            'price' => fake()->randomFloat(2, 1, 5000),
            'in_stock' => fake()->boolean(),
            'rating' => fake()->randomFloat(1, 0, 5),
        ];
    }
}
