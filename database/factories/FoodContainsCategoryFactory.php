<?php

namespace Database\Factories;

use App\Models\FoodContainsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodContainsCategoryFactory extends Factory
{
    protected $model = FoodContainsCategory::class;

    public function definition(): array
    {
        return [
            'FOD_ID' => $this->faker->word(),
        ];
    }
}
