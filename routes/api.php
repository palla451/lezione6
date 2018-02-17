<?php

use Illuminate\Http\Request;

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


// --- Route libere nel senso che sono raggiungibili senza middleware

Route::post('auth/register', 'UserController@register');

Route::post('auth/login', 'UserController@login');


// == installare e configurare JWT

// - 1 Installazione e configurazione del Package
// - 2 Creazione del middleware
// - 3 Creazione/protezione delle URL con il middleware
//  ---------------------------------------------




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('anagrafica','RsAnagraficaController');

