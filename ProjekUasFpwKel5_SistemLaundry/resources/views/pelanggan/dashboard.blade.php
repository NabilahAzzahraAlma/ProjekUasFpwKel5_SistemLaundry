@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
    <h3>Halo, {{ auth()->user()->name }}</h3>
    <p>Selamat datang di dashboard KangCuciExpress.</p>

    <div class="card p-3 mb-3">
        <h5>Status Laundry Terbaru</h5>
        @if ($pesananTerbaru)
            <p><strong>Kode:</strong> {{ $pesananTerbaru->kode_pesanan }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pesananTerbaru->status) }}</p>
            <p><a href="{{ route('pelanggan.pesanan.show', $pesananTerbaru->id) }}"
                    class="btn btn-outline-primary btn-sm">Lihat Detail</a></p>
        @else
            <p>Belum ada pesanan. <a href="{{ route('pelanggan.pesanan.create') }}">Buat sekarang</a>.</p>
        @endif
    </div>

    <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary">Buat Pesanan Baru</a>
@endsection
