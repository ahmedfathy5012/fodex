<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Seller;
use Faker\Generator as Faker;

$factory->define(Seller::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
       'phone' => rand(10000,1000000000),
       'major_id' => 2,
       'prepare_time' => 30,
      //  'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      //  'remember_token' => Str::random(10),
    ];
});
