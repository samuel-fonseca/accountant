<?php

namespace Tests\Feature\API;

use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_invoices()
    {
        $user = User::factory()->create();
        // $client = U
        $invoices = Invoice::factory(5)->for($user)->forClient()->create();

        $this->actingAs($user)
            ->json('get', '/api/invoices')
            ->dump();
    }
}
