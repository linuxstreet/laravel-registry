<?php

use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Linuxstreet\Registry\Registry::class, function (Faker $faker) {
    return [
        'key' => $faker->word,
        'comment' => $faker->text()
    ];
});
