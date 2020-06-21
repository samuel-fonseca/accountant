<?php

namespace App\Http\Controllers\Api;

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->login($request);
    }

    public function login(Request $request)
    {
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

            return $response->getBody();

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {

            if ($e->getCode() === 400) {
                return abort($e->getCode(), 'Bad Request. Enter a valid username/password');
            } else if ($e->getCode() === 401) {
                return abort($e->getCode(), 'Your credentials are incorrect. Please, try again.');
            }

            return abort($e->getCode(), 'Something went wrong on the server.');
        }
    }

    public function logout() {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('You have been logged out.');
    }
}
