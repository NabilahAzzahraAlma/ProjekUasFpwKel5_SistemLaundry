<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
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
            padding: 2rem;
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
        }
        .badge {
            font-weight: 600;
            padding: 0.5em 0.75em;
        }
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        .pagination {
            justify-content: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>

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
            <img src="https://via.placeholder.com/40" alt="Avatar" class="avatar">
        </header>

        <!-- Tabel Pesanan -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Pesanan Masuk</h5>
                <p class="card-subtitle text-muted mt-1">Daftar pesanan baru yang menunggu verifikasi dan penjadwalan.</p>
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
        @foreach ($orders as $order)
        <tr>
            <td><strong>ORD-{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</strong></td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->product_name }}</td>
            <td>
                <span class="badge bg-warning text-dark">{{ $order->status }}</span>
            </td>
            <td>
                {{-- Tombol Verifikasi --}}
                <form action="{{ route('orders.verify', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-check-lg"></i> Verifikasi
                    </button>
                </form>

                {{-- Tombol Tolak --}}
                <form action="{{ route('orders.reject', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-x-lg"></i> Tolak
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
