@extends('layouts.app')

@section('title', 'Pembayaran Laundry')

@section('content')
    <h4>Pembayaran Pesanan {{ $order->order_code }}</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Produk:</strong> {{ $order->product_name }}</p>
            <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($order->pembayaran->jumlah, 0, ',', '.') }}</p>
            <p><strong>Metode:</strong> {{ strtoupper($order->pembayaran->metode) }}</p>
            <p><strong>Status:</strong>
                <span class="badge bg-{{ $order->pembayaran->status == 'lunas' ? 'success' : 'warning' }}">
                    {{ ucfirst($order->pembayaran->status) }}
                </span>
            </p>

            @if ($order->pembayaran->metode == 'qris')
                <p>Silakan scan QR berikut (simulasi):</p>
                <img src="{{ $order->pembayaran->qr_link }}" alt="QRIS">
            @elseif($order->pembayaran->metode == 'va')
                <p>Nomor Virtual Account: <strong>{{ $order->pembayaran->virtual_account }}</strong></p>
            @endif
        </div>
    </div>

    @if ($order->pembayaran->status != 'lunas')
        <form action="{{ route('pembayaran.customerMarkPaid', $order->id) }}" method="POST">
            @csrf
            <button class="btn btn-success">Tandai Sudah Bayar (Simulasi)</button>
        </form>
    @endif
@endsection
