@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajukan Komplain</h2>

    <form action="{{ route('complaint.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type">Tipe Komplain</label>
            <select name="type" id="type" class="form-control" required>
                <option value="Kualitas Layanan">Kualitas Layanan</option>
                <option value="Keterlambatan">Keterlambatan</option>
                <option value="Kesalahan Pemesanan">Kesalahan Pemesanan</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Komplain</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="evidence">Bukti (Opsional)</label>
            <input type="file" name="evidence" id="evidence" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Komplain</button>
    </form>
</div>
@endsection
