@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Detail Komplain</h2>

    <p><strong>Nama Pelanggan:</strong> {{ $complaint->user->name }}</p>
    <p><strong>Tipe Komplain:</strong> {{ $complaint->type }}</p>
    <p><strong>Deskripsi Komplain:</strong></p>
    <p>{{ $complaint->description }}</p>

    @if ($complaint->evidence)
        <p><strong>Bukti:</strong></p>
        <img src="{{ asset('storage/' . $complaint->evidence) }}" alt="Bukti Komplain" class="img-fluid" />
    @else
        <p>Tidak ada bukti yang diunggah.</p>
    @endif

    <form action="{{ route('admin.verify.complaint', ['id' => $complaint->id, 'status' => 'verified']) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Verifikasi Komplain</button>
    </form>

    <form action="{{ route('admin.verify.complaint', ['id' => $complaint->id, 'status' => 'rejected']) }}" method="POST" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-danger">Tolak Komplain</button>
    </form>
</div>
@endsection
