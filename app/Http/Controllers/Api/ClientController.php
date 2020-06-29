<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->clients;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'max:55',
            'lastname' => 'max:55',
            'company' => 'max:110',
            'display_name' => 'required|max:110',
            'phone' => 'required|max:55',
            'email' => 'required|email',
            'address' => 'required|max:125',
            'city' => 'required|max:125',
            'state' => 'required|max:2',
            'zip' => 'required',
        ]);

        $client = $request->all();
        $client['user_id'] = auth()->user()->id;

        return Client::create($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Client::where([
            ['user_id', auth()->id()],
            ['id', $id]
        ])->with(['invoices', 'invoices.payments'])->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'max:55',
            'lastname' => 'max:55',
            'company' => 'max:110',
            'display_name' => 'required|max:110',
            'phone' => 'required|max:55',
            'email' => 'required|email',
            'address' => 'required|max:125',
            'city' => 'required|max:125',
            'state' => 'required|max:2',
            'zip' => 'required',
        ]);

        $client = $request->all();
        $client['user_id'] = auth()->id();

        return Client::where([
            ['id', $id],
            ['user_id', $client['user_id']]
        ])
        ->firstOrFail()
        ->update($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Client::find($id)->delete();
    }


    public function invoices($id)
    {
        $client = Client::where([
            ['user_id', auth()->id()],
            ['id', $id]
        ])->with(['invoices', 'invoices.payments'])->firstOrFail();

        return response($client->invoices, 200);
    }
}
