<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'user_id' => Str::uuid(),
        'client_id' => Str::uuid(),
        'invoice_number' => rand(1000, 9999),
        'line_items' => json_encode([
            [
                "rate" => "100",
                "total" => 100,
                "quantity" => "1",
                "description" => "Hello World"
            ],
            [
                "rate" => "430",
                "total" => 430,
                "quantity" => "1",
                "description" => "Hello World"
            ],
            [
                "rate" => "25",
                "total" => 100,
                "quantity" => "4",
                "description" => "Hello World"
            ],
            [
                "rate" => "42",
                "total" => 84,
                "quantity" => "2",
                "description" => "Hello World"
            ],
        ]),
        'message' => 'Hello World! This was created via a factory',
        'tax' => 0.00,
        'discount' => 84.00,
        'total' => 630.00,
        'invoiced_at' => $faker->date('Y-m-d'),
        'due_at' => $faker->date('Y-m-d'),
    ];
});
