<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoapController;
use \App\Http\Controllers\MySoapController;

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
    return view('welcome');
});

// WITH php2wsdl/php2wsdl
Route::get('/client', [SoapController::class, 'client'])->name('client');
Route::get('/wsdl', [SoapController::class, 'wsdl'])->name('wsdl');
Route::post('/server', [SoapController::class, 'server'])->name('server');

// WITH kduma/laravel-soap-server
Route::name('my_soap_server.wsdl')->get('/soap.wsdl', [MySoapController::class, 'wsdlProvider']);
Route::name('my_soap_server')->post('/soap', [MySoapController::class, 'soapServer']);
