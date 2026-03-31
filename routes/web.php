<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;


Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
