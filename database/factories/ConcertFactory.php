<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Concert;
use Faker\Generator as Faker;
use Symfony\Component\String\Slugger\AsciiSlugger;
use voku\helper\ASCII;

$factory->define(Concert::class, function (Faker $faker) {
    $slugger = new AsciiSlugger();
    $name = $faker->sentence(rand(2,3));
    $tickets = $faker->numberBetween(200, 1500);
    return [
        'name' => $name,
        'slug' => $slugger->slug($name),
        'date' => $faker->dateTimeBetween("-1 year", "+1 year"),
        'place' => $faker->address(),
        'price' => $faker->numberBetween(50, 200),
        'ticket_total' => $tickets,
        'ticket_left' => $tickets,
    ];
});
