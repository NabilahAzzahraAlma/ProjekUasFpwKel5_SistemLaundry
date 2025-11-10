<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});
// GET - Untuk MENAMPILKAN form (ini sudah Anda miliki)
Route::get('/orders/create', [OrderController::class, 'create']);

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
Route::resource('orders', OrderController::class);

Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'pelanggan' => redirect()->route('pelanggan.pesanan.index'),
        'admin', 'staf' => redirect()->route('admin.dashboard'),
        'owner' => redirect()->route('admin.laporan'),
        'driver' => redirect()->route('driver.dashboard'),
        default => redirect()->route('login'),
    };
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    // Pelanggan
    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        // Halaman pembayaran
        Route::get('/pembayaran/{order}', [PembayaranController::class, 'show'])
            ->name('pembayaran.show');

        // Pelanggan tandai lunas (simulasi)
        Route::post('/pembayaran/{order}/mark-paid', [PembayaranController::class, 'customerMarkPaid'])
            ->name('pembayaran.customerMarkPaid');
    });

    // Driver
    Route::prefix('driver')->name('driver.')->group(function () {
        // Driver konfirmasi pembayaran selesai
        Route::post('/pembayaran/{order}/confirm', [PembayaranController::class, 'konfirmasiOlehDriver'])
            ->name('pembayaran.konfirmasiDriver');
    });
});
