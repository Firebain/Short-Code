<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Data;
use Faker\Generator as Faker;

$factory->define(Data::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(2),
        "body" => $faker->text(),
        "page_uid" => $faker->uuid
    ];
});