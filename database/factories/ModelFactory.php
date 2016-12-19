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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/**
 * Band factory
 */
$factory->define(App\Models\Band\Band::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'start_date' => $faker->date(),
        'website' => $faker->url,
        'still_active' => rand(0, 1),
    ];
});

/**
 * Album factory
 */
$factory->define(App\Models\Band\Album::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'recorded_date' => $faker->date(),
        'release_date' => $faker->date(),
        'number_of_tracks' => rand(1, 16),
        'label' => $faker->word,
        'producer' => $faker->word,
        'genre' => $faker->word,
    ];
});
