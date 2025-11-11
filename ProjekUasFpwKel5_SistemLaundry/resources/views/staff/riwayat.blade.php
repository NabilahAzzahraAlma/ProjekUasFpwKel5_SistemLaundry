@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Transaksi Laundry</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Kode Pesanan</th>
                <th>Status</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayats as $r)
                <tr>
                    <td>{{ $r->pesanan->kode_pesanan }}</td>
                    <td>{{ $r->pesanan->status }}</td>
                    <td>{{ $r->tipe }}</td>
                    <td>Rp {{ number_format($r->jumlah,0,',','.') }}</td>
                    <td>{{ $r->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
