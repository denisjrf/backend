<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
Route::get('Estados', ['as' => 'Estados', 'uses' => 'App\Http\Controllers\UserController@Estados']);
Route::get('Ciudad', ['as' => 'Ciudad', 'uses' => 'App\Http\Controllers\UserController@Ciudad']);
Route::get('email', ['as' => 'email', 'uses' => 'App\Http\Controllers\UserController@email']);
Route::post('enviarEmail', ['as' => 'enviarEmail', 'uses' => 'App\Http\Controllers\UserController@enviarEmail']);
Route::get('emailsEnviados', ['as' => 'emailsEnviados', 'uses' => 'App\Http\Controllers\UserController@emailsEnviados']);
