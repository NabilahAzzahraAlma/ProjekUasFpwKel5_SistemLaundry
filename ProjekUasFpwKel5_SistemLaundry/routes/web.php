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
Route::post('/orders/{id}/verify', [OrderController::class, 'verify'])->name('orders.verify');
Route::post('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
Route::get('/orders/verified', [OrderController::class, 'verified'])->name('orders.verified');
// Tambahkan resource route
Route::resource('orders', OrderController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [UserController::class, 'index'])->name('user.profile');
    Route::get('/profil/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/profil/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/profil/password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/profil/password/update', [UserController::class, 'updatePassword'])->name('user.updatePassword');

    // Admin only
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/admin/users', [UserController::class, 'listUsers'])->name('admin.users.index');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});
