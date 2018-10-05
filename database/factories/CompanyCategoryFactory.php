<?php

$factory->define(App\CompanyCategory::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
    ];
});
