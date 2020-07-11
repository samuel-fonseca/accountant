<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register new user and grant Access Token
     * 
     * @return Response
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:50'],
            'state' => ['required', 'string', 'max:2'],
            'zip' => ['required', 'string', 'max:5'],
            'country' => ['required', 'string'],
            'billing_address' => ['max:255'],
            'billing_city' => ['max:50'],
            'billing_state' => ['max:2'],
            'billing_zip' => ['max:5'],
        ]);

        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);
        $token = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $token]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        $http = new \GuzzleHttp\Client;

        try {

            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);

            // return JSON response with token
            return response()->json(
                json_decode($response->getBody()->getContents())
            );

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            $response = json_decode($e->getResponse()->getBody()->getContents());

            return abort($e->getCode(), $response->message ?: 'Something broke. Please, try again later.');
        }
    }

    public function logout() {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('You have been logged out.');
    }
}
