<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Exports\DailySalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Cek Role (Hanya Owner dan Staff)
        if (!in_array(Auth::user()->role, ['owner', 'staff'])) {
            abort(403, 'Akses ditolak. Khusus Owner dan Staff.');
        }

        // 2. Ambil tanggal dari input, default ke hari ini
        $date = $request->input('date', date('Y-m-d'));

        // 3. Ambil data transaksi
        $transactions = Pembayaran::whereDate('created_at', $date)->get();

        // Hitung total pendapatan hari itu
        $totalRevenue = $transactions->sum('total_price'); // Sesuaikan nama kolom harga

        return view('reports.daily', compact('transactions', 'date', 'totalRevenue'));
    }

    public function export(Request $request)
    {
        // Cek Role lagi untuk keamanan
        if (!in_array(Auth::user()->role, ['owner', 'staff'])) {
            abort(403);
        }

        $date = $request->input('date', date('Y-m-d'));

        return Excel::download(new DailySalesExport($date), 'laporan-penjualan-' . $date . '.xlsx');
    }
}
