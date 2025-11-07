<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderVerificationsController extends Controller
{
    protected $fillable = ['order_id', 'verified_by', 'verified_at', 'notes'];

    // Verifikasi pesanan
    public function verify(Request $request, $id)
    {
        $request->validate([
            'notes' => 'nullable|string'
        ]);

        $order = Order::findOrFail($id);

        if ($order->status === 'verified') {
            return response()->json(['message' => 'Pesanan sudah diverifikasi'], 400);
        }

        // Update status pesanan
        $order->status = 'verified';
        $order->save();

        // Simpan ke tabel order_verifications
        $verification = OrderVerification::create([
            'order_id' => $order->id,
            'verified_by' => Auth::id() ?? 1, // ganti 1 jika belum pakai auth
            'verified_at' => now(),
            'notes' => $request->input('notes')
        ]);

        return response()->json([
            'message' => 'Pesanan berhasil diverifikasi',
            'verification' => $verification
        ]);
    }

    // Menampilkan semua verifikasi
    public function index()
    {
        $verifications = OrderVerification::with('order', 'verifier')->get();
        return response()->json($verifications);
    }
}
