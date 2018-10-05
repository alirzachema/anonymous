<?php

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "address" => $faker->name,
        "city_id" => factory('App\City')->create(),
        "state_id" => factory('App\State')->create(),
        "country" => $faker->name,
    ];
});
