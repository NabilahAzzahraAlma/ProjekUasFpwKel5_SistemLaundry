<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // pastikan model Order sudah ada
use Illuminate\Support\Facades\Auth;
class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil data pesanan milik user yang sedang login
        $orders = Order::where('user_id', $user->id)->latest()->get();

        // Hitung total per status
        $countMenunggu = $orders->where('status', 'Menunggu')->count();
        $countDiproses = $orders->where('status', 'Diproses')->count();
        $countSelesai  = $orders->where('status', 'Selesai')->count();
        $countDibatalkan = $orders->where('status', 'Dibatalkan')->count();

        // Hitung total harga keseluruhan
        $totalHarga = $orders->sum('total_harga');

        // Ambil 5 pesanan terakhir
        $latestOrders = $orders->take(5);

        return view('user.dashboard', compact(
            'user',
            'countMenunggu',
            'countDiproses',
            'countSelesai',
            'countDibatalkan',
            'totalHarga',
            'latestOrders'
        ));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
public function destroy(string $id)
    {
        //
    }
    }
