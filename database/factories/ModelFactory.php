<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\SponsoredLocation::class, function (Faker\Generator $faker) {
    $lat = rand(41894737039417, 41900132960583) / 1000000000000;
    $long = rand(-87639892627662, -87632643372338) / 1000000000000;

    return [
        'name' => $faker->company,
        'description' => $faker->text(),
        'incentive_text' => $faker->text(),
        'sponsor_id' => 84,
        'lat' => $lat,
        'long' => $long,
    ];
});
