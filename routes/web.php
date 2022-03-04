<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
Route::get('/docs', [DocsController::class, 'index'])->name('docs');
Route::get('/docs/database', [DocsController::class, 'databaseDocument'])->name('databaseDocument');

Auth::routes();
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/registerclient', [Auth\RegisterController::class, 'registerClient'])->name('registerClient');
Route::get('/registerdeveloper', [Auth\RegisterController::class, 'registerDeveloper'])->name('registerDeveloper');
Route::post('/createdeveloper', [Auth\RegisterController::class, 'createDeveloper'])->name('createDeveloper');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/developerhome', [DeveloperController::class, 'index'])->name('developerHome');
Route::post('/setapiaccess', [HomeController::class, 'setApiAccess']);

Route::post('/test-database-connection', [RegisterController::class, 'testDatabaseConnection']);
Route::post('/updateclient', [RegisterController::class, 'updateClient'])->name('updateClient');
