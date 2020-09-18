<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'type_quantity' => $faker->numberBetween(1, 1),
        'type_product' => $faker->numberBetween(1, 1),
        'image'=>$faker->imageUrl(80, 80),
        'is_active' => $faker->boolean()
    ];
});
