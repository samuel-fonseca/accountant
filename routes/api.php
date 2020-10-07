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

/**
 * Passport Auth Functions
 */
Route::post('/register', 'API\AuthController@register')->name('register');
Route::post('/login', 'API\AuthController@login')->name('login');
Route::middleware('auth:api')->post('/logout', 'API\AuthController@logout')->name('logout');

/**
 * Fetch user account || null (CODE: 401)
 */
Route::get('/user', 'API\AuthController@user')->name('user');

/**
 * Auth API middleware group
 */
Route::middleware('auth:api')->group(function () {
    // Route::resource('/expenses', 'API\ExpenseController');
    // Route::resource('/incomes', 'API\IncomeController');

    // Clients
    Route::get('/clients/{id}/invoices', 'API\ClientController@invoices');
    Route::resource('/clients', 'API\ClientController');

    // Invoices
    Route::post('/invoices/{id}/notify', 'API\InvoiceController@notify');
    Route::resource('/invoices', 'API\InvoiceController')->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    // Payments
    Route::resource('/payments', 'API\PaymentsController');

    // Route::resource('/banks', 'API\BankController')->only([
    //     'index', 'store', 'show', 'update', 'destroy'
    // ]);

});
