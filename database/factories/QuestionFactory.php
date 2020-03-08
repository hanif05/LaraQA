<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5, 10)), "."), //rtrim for remove .(dot)
        'body' => $faker->paragraphs(rand(3,7), true),
        // 'votes_count' => rand(-4, 10),
        'views' => rand(0, 10),
    ];
});
