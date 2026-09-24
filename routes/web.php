<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Booking now happens on the home page; keep old /form links working.
Route::permanentRedirect('/form', '/#invest');

Route::get('/currency', [CurrencyController::class, 'show'])->middleware('throttle:60,1')->name('currency.show');

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
