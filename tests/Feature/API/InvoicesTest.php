<?php

namespace Tests\Feature\API;

use App\Client;
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
        $user = User::factory()
            ->has(Client::factory())
            ->has(Invoice::factory(5))
            ->create();

        $this->actingAs($user)
            ->json('get', '/api/invoices')
            ->dump();
    }
}
