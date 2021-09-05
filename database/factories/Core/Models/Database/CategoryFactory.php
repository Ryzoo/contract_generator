<?php

namespace Database\Factories\Core\Models\Database;

use App\Core\Models\Database\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
