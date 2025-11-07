<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding: 2rem; }
        .card {
            border: none; border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            max-width: 800px; margin: auto;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Pesanan Baru</h5>
            <p class="card-subtitle text-muted mt-1">Isi detail pesanan di bawah ini.</p>
        </div>
        <div class="card-body">

            <form action="/orders" method="POST">
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

                <div class="mb-3">
                    <label for="quantity" class="form-label">Kuantitas (Contoh: 5 untuk 5kg)</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="total_price" name="total_price" placeholder="Contoh: 25000" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/orders" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                </div>

            </form>
        </div>
    </div>

    </body>
</html>
