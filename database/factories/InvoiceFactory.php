<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $line_items = [];
        $invoice_total = 0;

        for ($i = 0; $i < 5; $i++) {
            $amount = rand(0, 1500);
            $quantity = rand(1, 100);
            $total = $amount * $quantity;

            $line_items[$i] = [
                'description' => $this->faker->sentence(rand(1, 6), true),
                'rate' => $amount,
                'quantity' => $quantity,
                'total' => $total
            ];

            $invoice_total += $total;
        }

        $discount = rand(0, 150);

        if ($discount > $invoice_total) {
            $invoice_total = 0;
        } else {
            $invoice_total - $discount;
        }


        $tax = $invoice_total * 0.06; // kentucky sales tax

        $invoice_date = $this->faker->date('Y-m-d');
        $due_date = date('Y-m-d', strtotime('+30 days', strtotime($invoice_date)));

        return [
            'user_id' => Str::uuid(),
            'client_id' => Str::uuid(),
            'invoice_number' => rand(1000, 9999),
            'line_items' => $line_items,
            'message' => $this->faker->paragraph(rand(1, 3)),
            'tax' => $tax,
            'discount' => $discount,
            'total' => $invoice_total,
            'invoiced_at' => $invoice_date,
            'due_at' => $due_date,
        ];
    }
}
