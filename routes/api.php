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

Route::get('/info-thek/authenticate/{token}', 'Api\AuthenticationController@authenticate');

Route::post('/info-thek/login', 'Api\AuthenticationController@create_token');

Route::middleware('auth:sanctum')->get('/', function (Request $request) {
    return $request->user();
});
