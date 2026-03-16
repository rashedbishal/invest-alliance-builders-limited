<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', function () {
    return view('booking-form');
});

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

Route::get('invoice/access/{token}/sentinel', [InvoiceController::class, 'accessViaQr'])
    ->name('invoice-access');

Route::get('invoice/{invoice}/{concern}/download', [InvoiceController::class, 'downloadInvoice'])->name('admin-download-invoice');
