<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan pesanan masuk (Pending)
    public function index()
    {
        // Ganti 'Pending' sesuai dengan status default di 'store'
        $orders = Order::where('status', 'Pending')->paginate(5);
        // Pastikan view-nya ada di resources/views/orders/index.blade.php
        return view('orders.index', compact('orders'));
    }

    // Menampilkan pesanan yang sudah diverifikasi
    public function verified()
    {
        $orders = Order::where('status', 'Terverifikasi')->paginate(5);
        // Pastikan view-nya ada di resources/views/orders/verified.blade.php
        return view('orders.verified', compact('orders'));
    }

    // Verifikasi pesanan
    public function verify($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Terverifikasi'; // HARUS pakai tanda kutip ''
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diverifikasi!');
    }

    // Tolak pesanan
    public function reject($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Ditolak';
        $order->save();

        return redirect()->route('orders.index')->with('error', 'Pesanan ditolak!');
    }

    public function create()
    {
        // Daftar kategori jasa
        $categories = [
            'Cuci Baju',
            'Cuci Tas',
            'Cuci BedCover',
            'Cuci Jaket',
            'Cuci Boneka',
            'Cuci Karpet',
            'Cuci Gorden'
        ];

        // Daftar varian parfum
        $perfumes = ['Lavender', 'Ocean Breeze', 'Vanilla', 'Fresh Lemon'];

        // Pastikan view-nya ada di resources/views/orders/create.blade.php
        return view('orders.create', compact('categories', 'perfumes'));
    }

    // (PERBARUI METHOD INI)
    public function store(Request $request)
    {
        // Validasi data (Opsional tapi sangat disarankan)
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'category' => 'required|string',
            'perfume_variant' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        Order::create([
            'order_code'     => 'ORD-' . strtoupper(uniqid()),
            'customer_name'  => $request->customer_name,
            'product_name'   => $request->category . ' - ' . $request->perfume_variant,
            'quantity'       => $request->quantity,
            'total_price'    => $request->total_price,
            'order_date'     => now(),
            'status'         => 'Pending', // Pastikan status ini sama dengan di query 'index'
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function dashboard()
    {
        $userId = Auth::id();
        $pesananTerbaru = $userId ? Order::where('user_id', $userId)->latest()->first() : null;
        return view('pelanggan.dashboard', compact('pesananTerbaru'));
    }
}
