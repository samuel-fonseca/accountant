<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'name' => env('APP_NAME'),
            'description' => env('APP_DESCRIPTION'),
            'start_url' => url('/dashboard'),
            'scope' => '/',
            'display' => 'standalone',
            'background_color' => '#f2f2f2',
            'icons' => [[
                'src' => '',
                'sizes' => '',
                'tyoe' => '',
            ]], // create an icon for the app 🧮
        ]);
    }
}
