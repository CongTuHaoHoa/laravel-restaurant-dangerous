<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return
        [
            'CTG_ID',
            'CTG_NAME',
            'CTG_COLOR',
            'CTG_CREATED_AT',
            'CTG_UPDATED_AT',
        ];
    }
}
