@extends('layouts.app')

{{-- Menambahkan style khusus untuk halaman ini --}}
@push('styles')
<style>
    /* CSS Sidebar Anda */
    .wrapper {
        display: flex;
        min-height: calc(100vh - 100px); /* Adjust height based on navbar */
    }
    .sidebar {
        width: 250px;
        background-color: #fff;
        border-right: 1px solid #dee2e6;
        padding: 1.5rem;
        flex-shrink: 0;
    }
    .sidebar .nav-link {
        color: #495057;
        font-weight: 500;
        padding: 0.75rem 1rem;
    }
    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        color: #0d6efd;
        background-color: #e9ecef;
        border-radius: 0.5rem;
    }
    .sidebar .nav-link .bi {
        margin-right: 0.75rem;
    }
    .main-content {
        flex-grow: 1;
        padding: 0 2rem; /* Remove padding-top */
    }
    .header {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 2rem;
    }
    .header .form-control {
        max-width: 300px;
        margin-right: 1.5rem;
    }
    .header .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .card-header {
        background-color: #fff;
        border-bottom: none;
        padding: 1.5rem;
    }
    .table th {
        font-weight: 600;
        color: #6c757d;
    }
    .table td {
        color: #212529;
        vertical-align: middle;
    }
    .badge {
        font-weight: 600;
        padding: 0.5em 0.75em;
    }
    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('content')
<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h4 class="mb-4">Pesanan Admin</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('orders.index') }}">
                    <i class="bi bi-inbox-fill"></i> Pesanan Masuk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.verified') }}">
                    <i class="bi bi-check-circle-fill"></i> Pesanan Terverifikasi
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="header">
            <input type="search" class="form-control" placeholder="Cari pesanan...">
            <img src="https://placehold.co/40x40/EBF8FF/7F9CF5?text=A" alt="Avatar" class="avatar">
        </header>

        <!-- Tabel Pesanan -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Pesanan Masuk</h5>
                <p class="card-subtitle text-muted mt-1">Daftar pesanan baru yang menunggu verifikasi.</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Nama Produk</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td><strong>ORD-{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                                </td>
                                <td>
                                    {{-- Tombol Verifikasi (FIXED) --}}
                                    <form action="{{ route('orders.verify', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH') {{-- INI PERBAIKANNYA --}}
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-lg"></i> Verifikasi
                                        </button>
                                    </form>

                                    {{-- Tombol Tolak (FIXED) --}}
                                    <form action="{{ route('orders.reject', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-lg"></i> Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    Tidak ada pesanan masuk saat ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi (jika Anda menambahkannya di controller) -->
                <div class="mt-3">
                    {{-- $orders->links() --}}
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

{{-- Mendorong script ke layout utama --}}
@push('scripts')
<script>
    // Script JS khusus jika ada
</script>
@endpush
