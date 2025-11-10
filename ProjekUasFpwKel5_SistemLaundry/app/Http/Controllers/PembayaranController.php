<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Menampilkan halaman pembayaran pelanggan
    public function show($orderId)
    {
        $order = Order::with('pembayaran')->findOrFail($orderId);
        return view('pelanggan.pembayaran', compact('order'));
    }

    // Simulasi: pelanggan menandai pembayaran lunas
    public function customerMarkPaid($orderId)
    {
        $order = Order::with('pembayaran')->findOrFail($orderId);
        $pembayaran = $order->pembayaran;

        if (!$pembayaran) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $pembayaran->update(['status' => 'lunas']);
        $order->update(['status' => 'dikirim']);

        return back()->with('success', 'Pembayaran berhasil ditandai lunas (simulasi).');
    }


    // Driver/ Admin menandai pembayaran selesai
    public function konfirmasiOlehDriver($orderId)
    {
        $order = Order::with('pembayaran')->findOrFail($orderId);
        $pembayaran = $order->pembayaran;

        if (!$pembayaran) {
            return back()->with('error', 'Data pembayaran tidak ditemukan');
        }

        $pembayaran->update(['status' => 'lunas']);
        $order->update(['status' => 'selesai']);

        return back()->with('success', 'Driver telah konfirmasi pembayaran selesai.');
    }

    public function pembayaran($orderId)
    {
        return Pembayaran::where('order_id', $orderId)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
