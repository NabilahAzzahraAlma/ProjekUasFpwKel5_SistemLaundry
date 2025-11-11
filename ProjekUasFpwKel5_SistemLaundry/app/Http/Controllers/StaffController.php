<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\Order;

class StaffController extends Controller
{
     public function status(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status; // Diterima/Diantar/Dicuci/Proses/Selesai
        $order->save();

        // Jika status selesai → catat ke riwayat
        if ($request->status === 'Selesai') {
            Riwayat::create([
                'pesanan_id' => $order->id,
                'tipe' => 'Pemasukan',
                'jumlah' => $order->biaya,
            ]);
        }

        return redirect()->back()->with('success', 'Status cucian berhasil diperbarui!');

        
    }

    public function index()
    {
        $orders = Order::all();
        return view('staff.status', compact('orders'));
    }
}
