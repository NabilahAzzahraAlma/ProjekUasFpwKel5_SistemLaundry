<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>

<body>

    @extends('layouts.app')

    @section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm" style="border-radius: 0.75rem;">
                    <div class="card-header bg-white border-0 pt-3 pb-0">
                        <h5 class="card-title mb-0">Tambah Pesanan Baru</h5>
                        <p class="card-subtitle text-muted mt-1">Isi detail pesanan di bawah ini.</p>
                    </div>
                    <div class="card-body p-4">

                        <!-- Menggunakan route() lebih aman daripada hardcode '/orders' -->
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Pilih Kategori</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="" selected disabled>-- Pilih Kategori Jasa --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="perfume_variant" class="form-label">Pilih Varian Parfum</label>
                                <select class="form-select" id="perfume_variant" name="perfume_variant" required>
                                    <option value="" selected disabled>-- Pilih Varian Parfum --</option>
                                    @foreach ($perfumes as $perfume)
                                        <option value="{{ $perfume }}">{{ $perfume }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kolom quantity dan total_price dari file Anda -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Kuantitas (Contoh: 5kg)</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            value="1" min="1" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="total_price" class="form-label">Total Harga (Rp)</label>
                                        <input type="number" class="form-control" id="total_price" name="total_price"
                                            placeholder="Contoh: 25000" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Pilihan Metode Pembayaran -->
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="" selected disabled>-- Pilih Metode Pembayaran --</option>
                                    <option value="qris">QRIS</option>
                                    <option value="va">Virtual Account Bank</option>
                                    <option value="cash">Tunai</option>
                                </select>
                            </div>
                            <!-- QR statis / VA number (simulasi) -->
                            <div id="payment-info" class="mt-3" style="display:none;">
                                <div id="qris-info" style="display:none;">
                                    <p>Silakan scan QR berikut (simulasi):</p>
                                    <img src="https://via.placeholder.com/200x200.png?text=QRIS+Static" alt="QRIS Static">
                                </div>
                                <div id="va-info" style="display:none;">
                                    <p>Nomor Virtual Account: <strong>1234567890</strong></p>
                                </div>
                                <div id="cash-info" style="display:none;">
                                    <p>Pembayaran dilakukan langsung secara tunai kepada petugas.</p>
                                </div>
                            </div>

                            <script>
                                document.getElementById('payment_method').addEventListener('change', function() {
                                    document.getElementById('payment-info').style.display = 'block';
                                    document.getElementById('qris-info').style.display = 'none';
                                    document.getElementById('va-info').style.display = 'none';
                                    document.getElementById('cash-info').style.display = 'none';

                                    if (this.value === 'qris') {
                                        document.getElementById('qris-info').style.display = 'block';
                                    } else if (this.value === 'va') {
                                        document.getElementById('va-info').style.display = 'block';
                                    } else if (this.value === 'cash') {
                                        document.getElementById('cash-info').style.display = 'block';
                                    }
                                });
                            </script>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
