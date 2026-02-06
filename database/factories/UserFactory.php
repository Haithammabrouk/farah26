<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'nick_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'mobile' => $faker->randomNumber(),
        'gender' => $faker->randomElement(['male', 'female']),
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
    ];
});

// $factory->afterCreating(App\Models\User::class, function ($user, $faker) {
//     $user->saveMany(factory(App\Models\Post::class, 10)->make());
// });
//
// factory(App\Models\User::class, 50)->create()->each(function ($user) {$user-
// >posts()->saveMany(factory(App\Models\Post::class, 10)->make());});
