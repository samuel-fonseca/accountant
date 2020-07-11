<?php

namespace App\Http\Controllers\API;

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
        $client = auth()->user()->clients->load(['invoices', 'invoices.payments']);
        return response()->json($client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'nullable|max:55',
            'lastname' => 'nullable|max:55',
            'company' => 'nullable|max:110',
            'display_name' => 'required|max:110',
            'phone' => 'required|max:55',
            'email' => 'required|email',
            'address' => 'required|max:125',
            'city' => 'required|max:125',
            'state' => 'required|max:2',
            'zip' => 'required',
        ]);

        $validated['user_id'] = auth()->user()->id;
        $client = Client::create($validated);

        return response()->json($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->json(
            $client->load(['invoices', 'invoices.payments'])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'firstname' => 'nullable|max:55',
            'lastname' => 'nullable|max:55',
            'company' => 'nullable|max:110',
            'display_name' => 'required|max:110',
            'phone' => 'required|max:55',
            'email' => 'required|email',
            'address' => 'required|max:125',
            'city' => 'required|max:125',
            'state' => 'required|max:2',
            'zip' => 'required',
        ]);

        if ($client->update($validated))
            return response()->json($client->load(['invoices', 'invoices.payments']));
        else
            return response()->json(['message' => 'Could not update the client at this moment. Try again later.'], 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $name = $client->display_name;

        $client->delete();
        return response()->json(['message' => $name . ' has been deleted.']);
    }
}
