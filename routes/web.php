<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoapController;

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

Route::get('/soap.wsdl', [SoapController::class, 'wsdlProvider'])->name('soap_wsdl');
Route::post('/soap', [SoapController::class, 'soapServer'])->name('soap_server');
