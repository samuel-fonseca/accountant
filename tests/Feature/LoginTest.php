<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testApiLogin()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret123')
        ]);

        $response = $this->post('/api/login', [
            'username' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token_type','expires_in','access_token','refresh_token']);
    }

    /**
     * Check for invalid inputs for the Login
     * 
     * @return void
     */
    public function testInvalidInputs()
    {
        $response = $this->json('post', '/api/login', ['email' => null, 'password' => Str::random(100)], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
    }

    /**
     * Generate random bad credentials and test login
     * 
     * @return void
     */
    public function testBadCredentials()
    {
        $user = [
            'email' => 'someuser.' . Str::random() . '@example.org',
            'password' => Str::random()
        ];

        $response = $this->json('post', '/api/login', $user, [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(400);
    }

    /**
     * Make a put request to login
     * 
     * @return void
     */
    public function testBadRequest()
    {
        $response = $this->json('put', '/api/login', [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(405);
    }

    // public function testOauthLogin()
    // {
    //     $client_id = env('PASSPORT_CLIENT_ID');
    //     // $client = OauthClients::findOrFail()
    // }
}
