<?php


use App\Core\Models\Domain\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Category::class, function (Faker $faker) {
    return [
        "name" => $faker->word
    ];
});
