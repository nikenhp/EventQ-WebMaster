<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(["prefix"=>"/home"],function()
{
    Route::get('/',
        [
            "uses" => 'Auth\HomeController@index',
            "as" => 'home'
        ]);

    Route::get('/profile',
        [
            "uses"=>"ProfileController@index",
            "as"=>"profile"
        ]);
});

//Routing untuk Login & Register USER - Autentikasi
Route::group(['prefix' => '/'],function()
{
    Route::get('/', function ()
    {
        return view('welcome');
    });


    Route::get('/register',
        [
            "uses" => 'Auth\RegisterController@index',
            "as" => 'register'
        ]);

    Route::post('/register',
        [
            "uses" => "Auth\RegisterController@createUser",
            "as" => 'register'
        ]);

    Route::get('/login',
        [
            "uses" => 'Auth\LoginController@index',
            "as" => 'login'
        ]);

    Route::post('/login',
        [
            "uses" => 'Auth\LoginController@loginUser',
            "as" => 'login'
        ]);

    Route::post('/logout',
        [
            "uses" => 'Auth\LoginController@logoutUser',
            "as" => 'logout'
        ]);
});

//Routing untuk page Database User
Route::group(['prefix' => '/account'],function()
{
    Route::get('/', [
        "uses" => "Database\Account\AccountController@index",
        "as" => "account"
    ]);

    Route::get('/data_table',[
        "uses"=>"Database\Account\AccountController@getDataTable",
        "as"=>"account.dt"
    ]);

    Route::get('/add',[
        "uses"=>"Database\Account\AccountController@create",
        "as"=>"account.dt.cr"
    ]);

    Route::post('/store',[
       "uses"=>"Database\Account\AccountController@store",
       "as"=>"account.pst"
    ]);

    Route::get('/edit/{id}',[
        "uses"=>"Database\Account\AccountController@edit",
        "as"=>"account.edt"
    ]);

    Route::post('/update/{id}',[
        "uses"=>"Database\Account\AccountController@update",
        "as"=>"account.upd"
    ]);

    Route::get('/delete/{id}',[
        "uses"=>"Database\Account\AccountController@delete",
        "as"=>"account.del"
    ]);
});

//Routing untuk page Database Event
Route::group(['prefix'=>'/event'],function ()
{
    Route::get('/',[
        "uses"=>"Database\Event\EventController@index",
        "as"=>"event"
    ]);

    Route::get('/data_table',[
        "uses"=>"Database\Event\EventController@getDataTable",
        "as"=>"event.dt"
    ]);

    Route::get('/add',[
        "uses"=>"Database\Event\EventController@create",
        "as"=>"event.dt.cr"
    ]);

    Route::post('/store',[
        "uses"=>"Database\Event\EventController@store",
        "as"=>"event.pst"
    ]);

    Route::get('/edit/{id}',[
        "uses"=>"Database\Event\EventController@edit",
        "as"=>"event.edt"
    ]);

    Route::post('/update/{id}',[
        "uses"=>"Database\Event\EventController@update",
        "as"=>"event.upd"
    ]);

    Route::get('/delete/{id}',[
        "uses"=>"Database\Event\EventController@delete",
        "as"=>"eventss.del"
    ]);
});

//Routing untuk page Database Adminstrator
Route::group(['prefix'=>'/admin'],function ()
{
    Route::get('/',[
        "uses"=>"Database\Admin\AdminController@index",
        "as"=>"admin"
    ]);
});