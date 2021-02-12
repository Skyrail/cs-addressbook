<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::get('/contacts', function (Request $request) {
    #TODO: Handle pagination - page number, result count
    #TODO: Load contacts using given filter (query) - if it exists 
    return response()->json([
        'response' => 'Return all contacts',
        'query' => $request->query('query')
    ]);
});

Route::get('/contact/{contact_id}', function (Request $request, $contact_id) {
    #TODO: Load contact using the given contact_id
    return response()->json([
        'response' => 'Return specific contact',
        'contact_id' => $contact_id
    ]);
});