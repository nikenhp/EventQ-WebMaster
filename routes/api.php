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

//API Register
Route::post('/register','API\ApiRegisterController@create');
Route::get('/show','API\ApiRegisterController@show');
Route::get('/detailuser/{id}','API\ApiRegisterController@detailuser');
Route::post('/update/{id}','API\ApiRegisterController@updateuser');
Route::delete('/delete/{id}','API\ApiRegisterController@delete');

//API Login
Route::post('/login','API\ApiLoginController@login');

//API Event
Route::post('/upload_event','API\ApiEventController@create');
Route::get('/show_event','API\ApiEventController@show');
Route::post('/update_event/{id}','API\ApiEventController@update');
Route::delete('/delete_event/{id}','API\ApiEventController@delete');


//API Search
Route::get('/search/{name}','API\ApiEventController@search');

//API test
//Route::get('/account','Database\Account\AccountController@json');
//Route::get('/event','Database\Event\EventController@getDataTable');

//API Event Participant
Route::post('/create_eventpart','API\ApiEventParticipantController@register');
Route::get('/show_eventpart','API\ApiEventParticipantController@show');