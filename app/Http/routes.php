<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
   return response()->json(['status' => 'successful', 'version' => '0.1.3']);
});

Route::get('/places/nearby', ['uses' => 'PlaceController@searchNearby']);

Route::post('venues/batch', ['uses' => 'VenueController@batchCreate']);
Route::resource('venues', 'VenueController');

Route::get('opcache/clear', function () {

    if (function_exists('opcache_reset')) {
        opcache_reset();
    } else {
        return response('looks like OpCache is not enabled');
    }

    return response('OPCache Cleared!');
});