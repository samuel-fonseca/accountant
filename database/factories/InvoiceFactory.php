<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Invoice::class, function (Faker $faker) {
    $line_items = [];
    $invoice_total = 0;

    for ($i = 0; $i < 5; $i++) {
        $amount = rand(0, 1500);
        $quantity = rand(1, 100);
        $total = $amount * $quantity;

        $line_items[$i] = [
            'description' => $faker->sentence(rand(1, 6), true),
            'rate' => $amount,
            'quantity' => $quantity,
            'total' => $total
        ];

        $invoice_total += $total;
    }

    $discount = rand(0, 150);

    if ($discount > $invoice_total) $invoice_total = 0;
    else $invoice_total - $discount;


    $tax = $invoice_total * 0.06; // kentucky sales tax

    $invoice_date = $faker->date('Y-m-d');
    $due_date = date('Y-m-d', strtotime('+30 days'. strtotime($invoice_date)));

    return [
        'user_id' => Str::uuid(),
        'client_id' => Str::uuid(),
        'invoice_number' => rand(1000, 9999),
        'line_items' => json_encode($line_items),
        'message' => $faker->paragraph(rand(1, 3)),
        'tax' => $tax,
        'discount' => $discount,
        'total' => $invoice_total,
        'invoiced_at' => $invoice_date,
        'due_at' => $due_date,
    ];
});
