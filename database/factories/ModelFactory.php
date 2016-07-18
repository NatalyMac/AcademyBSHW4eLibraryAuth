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
        'firstname' => $faker->name,
        'lastname' =>  $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role'=>'reader',

    ];
});


$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'title'  => $faker->sentence(3),
        'author' => $faker->name,
        'genre'  =>  $faker->sentence(1),
        'year'   => random_int(1910, 2015),
    ];
});


$factory->define(App\Lend::class, function (Faker\Generator $faker) {
    return [
        'date_getin_plan' => date ('Y:m:d H:m:s', (time()+60000)),
        'date_getin_fact' => date ('Y:m:d H:m:s', (time()+120000)),
        'user_id' =>  App\User::all()->random(1)->id,
        'book_id' => App\Book::all()->random(1)->id,
    ];
});