<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\Order;

class PelangganController extends Controller
{
    public function Status(Request $request, $id)
    {
        // Ambil pesanan berdasarkan kode dan sertakan riwayatnya
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        if ($request->status === 'Selesai') {
            Riwayat::create([
                'order_id' => $order->id,
                'status' => 'Selesai',
                'changed_by_id' => auth()->id() ?? 1,
                'changed_by_role' => 'pelanggan',
                'notes' => 'Status selesai oleh pelanggan'
            ]);
        }
        return redirect()->back()->with('success', 'Status cucian berhasil diperbarui!');
        
    }
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())->get(); // opsional filter
        return view('pelanggan.status', compact('orders'));
    }
}
