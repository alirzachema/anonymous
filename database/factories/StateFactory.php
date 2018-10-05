<?php

$factory->define(App\State::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
