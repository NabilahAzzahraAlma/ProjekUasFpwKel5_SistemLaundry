<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Menampilkan pesanan masuk (Pending)
    public function index()
    {
        $orders = Order::where('status', 'Pending')->paginate(5);
        return view('orders.index', compact('orders'));
    }

    // Menampilkan pesanan yang sudah diverifikasi
    public function verified()
    {
        $orders = Order::where('status', 'Terverifikasi')->paginate(5);
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
    $perfumes = [
        'Lavender',
        'Ocean Breeze',
        'Vanilla',
        'Fresh Lemon'
    ];

    // Kirim data ke view
    return view('orders.create', compact('categories', 'perfumes'));
}
public function store(Request $request)
{
    Order::create([
        'order_code'     => 'ORD-' . strtoupper(uniqid()),
        'customer_name'  => $request->customer_name,
        'product_name'   => $request->category . ' - ' . $request->perfume_variant,
        'order_date'     => now(), // isi otomatis tanggal saat pesanan dibuat
        'status'         => 'Pending',
    ]);

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan!');
}
}
