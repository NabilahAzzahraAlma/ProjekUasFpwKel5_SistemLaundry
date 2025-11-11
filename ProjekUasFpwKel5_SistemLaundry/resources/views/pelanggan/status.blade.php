@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Status Cucian Anda</h2>
    @if($order)
        <p>Kode Pesanan: {{ $order->kode_pesanan }}</p>
        <p>Status: <span class="badge bg-info">{{ $order->status }}</span></p>
        <p>Berat: {{ $order->berat }} kg</p>
        <p>Biaya: Rp {{ number_format($order->biaya,0,',','.') }}</p>
    @else
        <p>Belum ada pesanan aktif.</p>
    @endif
</div>
@endsection
