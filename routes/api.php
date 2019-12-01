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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('festivals', 'FestivalController@index');
Route::get('festival/{id}', 'FestivalController@show');
Route::post('festival', 'FestivalController@store');
Route::put('festival', 'FestivalController@store');
Route::delete('festival/{id}', 'FestivalController@destroy');
