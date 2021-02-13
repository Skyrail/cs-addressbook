<?php

use App\Http\Controllers\ContactsApiController;
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

Route::get('/contacts', [ContactsApiController::class, 'getContacts']);
Route::get('/contact/{contact_id}', [ContactsApiController::class, 'getContact']);