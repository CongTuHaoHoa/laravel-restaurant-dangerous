<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    protected $model = Food::class;

    public function definition(): array
    {
        return [
            'FOD_ID',
            'FOD_NAME',
            'FOD_DESCRIPTION',
            'FOD_PRICE',
            'FOD_IMAGE',
            'FOD_CREATED_AT',
            'FOD_UPDATED_AT',
        ];
    }
}
