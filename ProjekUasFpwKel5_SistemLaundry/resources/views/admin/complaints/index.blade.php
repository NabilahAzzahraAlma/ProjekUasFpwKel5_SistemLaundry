@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Daftar Komplain Pelanggan</h2>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tipe Komplain</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $complaint)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $complaint->user->name }}</td>
                    <td>{{ $complaint->type }}</td>
                    <td>
                        <span class="badge @if($complaint->status == 'pending') badge-warning @elseif($complaint->status == 'verified') badge-success @else badge-danger @endif">
                            {{ ucfirst($complaint->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.verify.complaint', ['id' => $complaint->id, 'status' => 'verified']) }}" class="btn btn-success">Verifikasi</a>
                        <a href="{{ route('admin.verify.complaint', ['id' => $complaint->id, 'status' => 'rejected']) }}" class="btn btn-danger">Tolak</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
