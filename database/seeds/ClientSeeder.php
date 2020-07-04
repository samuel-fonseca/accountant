<?php

use App\Client;
use App\Invoice;
use App\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();

        if ($user) {
            $id = $user[0]->id;
        } else 
        {
            $user = factory(User::class)->create();
            $id = $user->id;
        }

        factory(Client::class, 100)->create(['user_id' => $id])->each(function ($client) use ($id) {
            for ($i = 0; $i < rand(2, 10); $i++) {
                $client->invoices()->save(factory(Invoice::class)->make(['user_id' => $id]));
            }
        });

    }
}
