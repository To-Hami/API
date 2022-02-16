<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->text,
    ];
});
