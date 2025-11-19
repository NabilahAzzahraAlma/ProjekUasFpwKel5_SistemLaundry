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
                'order_id' => $order->id,
                'status' => 'Selesai',
                'changed_by_id' => auth()->id() ?? 1,
                'changed_by_role' => 'staff',
                'notes' => 'Status selesai oleh staff'
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
