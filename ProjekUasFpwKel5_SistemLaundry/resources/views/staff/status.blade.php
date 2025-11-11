@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Status Semua Pesanan Laundry</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Kode Pesanan</th>
                <th>User ID</th>
                <th>Jenis Cucian</th>
                <th>Status</th>
                <th>Berat</th>
                <th>Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->kode_pesanan }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->jenis_cucian }}</td>
                    <td>
                        <span class="badge 
                            @if($order->status == 'Diterima') bg-success 
                            @elseif($order->status == 'Proses') bg-warning text-dark 
                            @elseif($order->status == 'Dicuci') bg-orange text-white 
                            @elseif($order->status == 'Diantar') bg-secondary 
                            @elseif($order->status == 'Selesai') bg-danger 
                            @else bg-info @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->berat }} kg</td>
                    <td>Rp {{ number_format($order->biaya,0,',','.') }}</td>
                    <td>
                        <!-- Form ubah status -->
                        <form action="{{ route('staff.status', $order->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <select name="status" class="form-select form-select-sm me-2" required>
                                <option value="Diterima" {{ $order->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Proses" {{ $order->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Dicuci" {{ $order->status == 'Dicuci' ? 'selected' : '' }}>Dicuci</option>
                                <option value="Diantar" {{ $order->status == 'Diantar' ? 'selected' : '' }}>Diantar</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Tambahkan warna oranye custom --}}
<style>
    .bg-orange {
        background-color: #fd7e14 !important;
    }
</style>
@endsection
