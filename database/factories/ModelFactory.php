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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\User;
use App\Profile;





$factory->define(User::class, function (Faker $faker) {
    return [

        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' =>$faker->username,
        'password' => bcrypt('secret'),
        'remember_token' => Str::random(10),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        //'is_active' => 1,
    ];
});

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'image' =>$faker->shuffleString(),
        'gender' => $faker->text,
        'dateofbirth' => $faker->date(),
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'user_id' => factory(User::class)->create([
            'password' => bcrypt('password'),
        ])->id,
    ];
});
