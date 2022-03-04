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

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }

    return view('welcome');
});
Route::get('/docs', 'DocsController@index')->name('docs');
Route::get('/docs/database', 'DocsController@databaseDocument')->name('databaseDocument');

Auth::routes();
Route::post('/login', 'LoginController@authenticate');
Route::post('/registerclient', 'Auth\RegisterController@registerClient')->name('registerClient');
Route::get('/registerdeveloper', 'Auth\RegisterController@registerDeveloper')->name('registerDeveloper');
Route::post('/createdeveloper', 'Auth\RegisterController@createDeveloper')->name('createDeveloper');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/developerhome', 'DeveloperController@index')->name('developerHome');
Route::post('/setapiaccess', 'HomeController@setApiAccess');

Route::post('/test-database-connection', 'RegisterController@testDatabaseConnection');
Route::post('/updateclient', 'RegisterController@updateClient')->name('updateClient');
