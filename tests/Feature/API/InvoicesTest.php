<?php

namespace Tests\Feature\API;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class InvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_invoices()
    {
        $user = User::factory()->create();
        $client = Client::factory()->for($user)->create();
        $invoices = Invoice::factory(5)->for($user)->for($client)->create();

        Passport::actingAs($user);

        $this->json('get', '/api/invoices')
            ->assertOk()
            ->dump()
            ->assertJsonCount(5, 'data')
            ->assertJsonPath('data.0.invoice_number', $invoices[0]->invoice_number)
            ->assertJsonPath('data.0.line_items.0.description', $invoices[1]->line_items[0]->description);
    }
}
