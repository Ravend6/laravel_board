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

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->email,
//         'password' => bcrypt(str_random(10)),
//         'remember_token' => str_random(10),
//     ];
// });
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => 'root',
        'email' => 'root@email.com',
        'password' => bcrypt('qwerty'),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        // 'user_id' => factory(App\User::class)->create()->id,
        'user_id' => 1,
        'title' => $faker->sentence,
        'slug' => str_slug($faker->word, '-'),
        'body' => $faker->paragraph,
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        // 'user_id' => factory(App\User::class)->create()->id,
        'user_id' => 1,
        'title' => $faker->sentence,
        'slug' => str_slug($faker->word, '-'),
        'body' => $faker->paragraph,
    ];
});