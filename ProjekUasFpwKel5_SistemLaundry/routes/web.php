<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
// GET - Untuk MENAMPILKAN form (ini sudah Anda miliki)
Route::get('/orders/create', [OrderController::class, 'create']);

// ▼▼ TAMBAHKAN ROUTE INI ▼▼
// POST - Untuk MENYIMPAN data dari form
Route::post('/orders', [OrderController::class, 'store']);

// GET - Untuk menampilkan daftar pesanan
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/verified', [OrderController::class, 'verifiedOrders']);

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/verified', [OrderController::class, 'verified'])->name('orders.verified');

// Tombol aksi
Route::post('/orders/{id}/verify', [OrderController::class, 'verify'])->name('orders.verify');
Route::post('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');

Route::post('/orders/{id}/verify', [OrderController::class, 'verify'])->name('orders.verify');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::patch('/orders/{id}/verify', [OrderController::class, 'verify'])->name('orders.verify');
Route::patch('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
Route::get('/orders/verified', [OrderController::class, 'verified'])->name('orders.verified');
// Tambahkan resource route
Route::resource('orders', OrderController::class);

