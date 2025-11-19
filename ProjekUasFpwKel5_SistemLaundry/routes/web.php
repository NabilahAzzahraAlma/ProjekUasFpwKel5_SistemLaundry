<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\StaffController;

// Maaf ya ini di comment dlu mau ngetes
// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

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
        'admin', 'staff' => redirect()->route('admin.dashboard'),
        'owner' => redirect()->route('admin.laporan'),
        'driver' => redirect()->route('driver.dashboard'),
        default => redirect()->route('login'),
    };
})->middleware(['auth'])->name('dashboard');

Route::get('/pembayaran/{order}', [PembayaranController::class, 'show'])
    ->name('pembayaran.show');
Route::post('/pembayaran/{orderId}/konfirmasi-driver', [PembayaranController::class, 'konfirmasiOlehDriver'])->name('pembayaran.konfirmasiDriver');
Route::post('/pembayaran/{orderId}/mark-paid', [PembayaranController::class, 'customerMarkPaid'])
    ->name('pembayaran.customerMarkPaid');

// Route::middleware(['auth'])->group(function () {
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
// });






// use App\Http\Controllers\StaffController;
use App\Http\Controllers\PelangganController;


// Route untuk pelanggan
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/pelanggan/status', [OrderController::class, 'status'])->name('pelanggan.status');
});
Route::get('/status/{kode_pesanan}', [PelangganController::class, 'Status'])->name('status.pelanggan');
Route::get('/pelanggan/status', [OrderController::class, 'status'])->name('pelanggan.status');


// Route untuk staff
// Route::middleware(['auth', 'role:staff'])->group(function () {
//     Route::get('/staff/riwayat', [StaffController::class, 'riwayat'])->name('staff.riwayat');
//     Route::get('/staff/status', [StaffController::class, 'status'])->name('staff.status');
// });
Route::get('/staff/riwayat', [StaffController::class, 'riwayat'])->name('staff.riwayat');
Route::get('/staff/status', [StaffController::class, 'index'])->name('staff.status.index');
Route::post('/staff/status/{id}', [StaffController::class, 'status'])->name('staff.status');


// route untuk complaint
Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::get('/admin/complaints', [ComplaintController::class, 'showAdmin'])->name('admin.complaints');
Route::post('/admin/complaints/{id}/{status}', [ComplaintController::class, 'verifyComplaint'])->name('admin.verify.complaint');