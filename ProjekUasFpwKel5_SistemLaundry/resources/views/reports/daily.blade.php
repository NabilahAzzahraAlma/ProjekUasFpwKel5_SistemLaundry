@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Monitoring Penjualan Harian</h4>

                        <form action="{{ route('reports.daily') }}" method="GET" class="d-flex">
                            <input type="date" name="date" class="form-control me-2" value="{{ $date }}">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Total Pendapatan ({{ \Carbon\Carbon::parse($date)->format('d M Y') }}):</strong>
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{ route('reports.export', ['date' => $date]) }}" class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Export ke Excel
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Layanan</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->user->name ?? 'Umum' }}</td>
                                            <td>{{ $item->service_name }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->status == 'completed' ? 'success' : 'warning' }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td>{{ $item->created_at->format('H:i') }}</td>
                                            <td class="text-end">Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada transaksi pada tanggal ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
