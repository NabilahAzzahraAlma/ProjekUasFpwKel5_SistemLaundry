<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DailySalesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        // Mengambil data transaksi berdasarkan tanggal yang dipilih
        // Pastikan status transaksi sudah 'selesai' atau 'dibayar' jika diperlukan
        return Pembayaran::whereDate('created_at', $this->date)->get();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Pelanggan',
            'Layanan',
            'Total Harga',
            'Tanggal',
            'Status',
        ];
    }

    public function map($transaction): array
    {
        // Sesuaikan field di bawah ini dengan nama kolom di database Anda
        return [
            $transaction->id,
            $transaction->user->name ?? 'Guest', // Asumsi ada relasi ke user
            $transaction->service_name,
            $transaction->total_price,
            $transaction->created_at->format('d-m-Y H:i'),
            $transaction->status,
        ];
    }
}
