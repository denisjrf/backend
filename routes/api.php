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
Route::group(['prefix' => 'billetera'], function () {
    Route::post('registroClientes', ['as' => 'registroClientes', 'uses' => 'App\Http\Controllers\Billetera\RegistroClientesController@registroClientes']);
    Route::post('recargarBilletera', ['as' => 'recargarBilletera', 'uses' => 'App\Http\Controllers\Billetera\BilleteraController@recargarBilletera']);
    Route::get('consultarBilleteraSaldo', ['as' => 'consultarBilleteraSaldo', 'uses' => 'App\Http\Controllers\Billetera\BilleteraController@consultarBilleteraSaldo']);
    Route::post('pagarCompra', ['as' => 'pagarCompra', 'uses' => 'App\Http\Controllers\Billetera\BilleteraController@pagarCompra']);
    Route::post('confirmarPago', ['as' => 'confirmarPago', 'uses' => 'App\Http\Controllers\Billetera\BilleteraController@confirmarPago']);
});
