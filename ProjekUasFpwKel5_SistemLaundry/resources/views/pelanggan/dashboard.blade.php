@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
    <h3>Halo, {{ auth()->user()->name }}</h3>
    <p>Selamat datang di dashboard KangCuciExpress.</p>

    <div class="card p-3 mb-3">
        <h5>Status Laundry Terbaru</h5>
        @if ($pesananTerbaru)
            <p>Kode Pesanan: {{ $pesananTerbaru->order_code }}</p>
            <p>Status: {{ ucfirst($pesananTerbaru->status) }}</p>
            <a href="{{ route('pembayaran.show', $pesananTerbaru->id) }}" class="btn btn-success">Bayar Sekarang</a>
        @else
            <p>Belum ada pesanan. <a href="{{ route('pelanggan.pesanan.create') }}">Buat sekarang</a>.</p>
        @endif
    </div>

    <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary">Buat Pesanan Baru</a>
@endsection
