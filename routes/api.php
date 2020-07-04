<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::resource('/expenses', 'Api\ExpenseController');
    Route::resource('/incomes', 'Api\IncomeController');

    Route::get('/clients/{id}/invoices', 'Api\ClientController@invoices');
    Route::resource('/clients', 'Api\ClientController');

    Route::post('/invoices/{id}/notify', 'Api\InvoiceController@notify');
    Route::resource('/invoices', 'Api\InvoiceController');

    Route::resource('/banks', 'Api\BankController')->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

});

/**
 * Passport Auth Functions
 */
Route::post('/register', 'Api\AuthController@register')->name('register');
Route::post('/login', 'Api\AuthController@login')->name('login');
Route::middleware('auth:api')->post('/logout', 'Api\AuthController@logout')->name('logout');
