<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(rand(10, 50)),
        'description' => $faker->realText(rand(1000, 2000)),
        'type_recipe' => $faker->numberBetween(1, 1),
        'cooking_time' => $faker->numberBetween(5, 120),
        'user_id' => $faker->numberBetween(1, 1),
        'kkal' => $faker->numberBetween(5, 1000),
        'photo_head' => $faker->imageUrl(1100, 500),
        'is_active' => $faker->boolean(95),
        'is_main' => $faker->boolean(10),
        'difficulty' => $faker->numberBetween(1, 3),
    ];
});
