<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Spell;
use Faker\Generator as Faker;

$factory->define(Spell::class, function (Faker $faker) {
    return [
        'name' => $slug = $faker->name,
        'quote' => $faker->sentence,
        'description' => $faker->paragraph,
        'kind_id' => function () {
            return App\Kind::inRandomOrder()->first();
        },
    ];
});
