<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/form', function () {
    return view('booking-form');
})->name('form');

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

Route::post('/paypal/create', [PayPalPaymentController::class, 'create'])->name('paypal.create');
Route::get('/paypal/success', [PayPalPaymentController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalPaymentController::class, 'cancel'])->name('paypal.cancel');

Route::get('invoice/access/{token}/sentinel', [InvoiceController::class, 'accessViaQr'])
    ->name('invoice-access');

Route::get('invoice/{invoice}/{concern}/download', [InvoiceController::class, 'downloadInvoice'])->name('admin-download-invoice');
