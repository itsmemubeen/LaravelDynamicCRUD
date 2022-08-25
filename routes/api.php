<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Country\CountryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('country', 'App\Http\Controllers\Country\CountryController@country');
// Route::get(
//     'country/{id}',
//     'App\Http\Controllers\Country\CountryController@countryByID'
// );
// Route::post(
//     'country',
//     'App\Http\Controllers\Country\CountryController@countrySave'
// );
// Route::put(
//     'country/{id}',
//     'App\Http\Controllers\Country\CountryController@countryUpdate'
// );
// Route::delete(
//     'country/{country}',
//     'App\Http\Controllers\Country\CountryController@countryDelete'
// );

Route::apiResource('country', 'App\Http\Controllers\Country\CountryC');