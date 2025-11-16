@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">👋 Halo, {{ $user->name }}</h2>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center bg-warning text-white">
                    <div class="card-body">
                        <h4>{{ $countMenunggu }}</h4>
                        <p>Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-primary text-white">
                    <div class="card-body">
                        <h4>{{ $countDiproses }}</h4>
                        <p>Diproses</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-success text-white">
                    <div class="card-body">
                        <h4>{{ $countSelesai }}</h4>
                        <p>Selesai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-danger text-white">
                    <div class="card-body">
                        <h4>{{ $countDibatalkan }}</h4>
                        <p>Dibatalkan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <strong>Total Pengeluaran</strong>
            </div>
            <div class="card-body">
                <h3>Rp {{ number_format($totalHarga, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">
                <strong>Pesanan Terbaru</strong>
            </div>
            <div class="card-body">
                @if($latestOrders->isEmpty())
                    <p>Belum ada pesanan.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Layanan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestOrders as $order)
                                <tr>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>{{ $order->jenis_layanan }}</td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge
                                                @if($order->status == 'Menunggu') bg-warning
                                                @elseif($order->status == 'Diproses') bg-primary
                                                @elseif($order->status == 'Selesai') bg-success
                                                @else bg-danger @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
