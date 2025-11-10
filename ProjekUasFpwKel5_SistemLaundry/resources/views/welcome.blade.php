@extends('layouts.app')

@section('title', 'KangCuciExpress - Laundry Cepat dan Bersih')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-5 fw-bold text-primary">Selamat Datang di KangCuciExpress</h1>
        <p class="lead mb-4">Solusi digital untuk layanan laundry cepat, bersih, dan wangi!<br>
            Nikmati pemesanan online, pelacakan status cucian, dan pembayaran QRIS langsung dari web.
        </p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg m-2">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg m-2">Daftar Sekarang</a>
        @else
            <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Masuk ke Dashboard</a>
        @endguest

        <div class="mt-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3565/3565899.png" alt="Laundry" width="200">
        </div>
    </div>

    <section class="mt-5 text-center">
        <h2 class="fw-bold mb-3">Mengapa Pilih KangCuciExpress?</h2>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <img src="https://cdn-icons-png.flaticon.com/512/1067/1067566.png" width="80">
                <h5 class="mt-3">Cepat & Bersih</h5>
                <p>Setiap cucian diproses dengan mesin modern dan parfum pilihan pelanggan.</p>
            </div>
            <div class="col-md-3">
                <img src="https://cdn-icons-png.flaticon.com/512/2593/2593630.png" width="80">
                <h5 class="mt-3">Tracking Online</h5>
                <p>Pelanggan dapat memantau status cucian secara real-time dari dashboard web.</p>
            </div>
            <div class="col-md-3">
                <img src="https://cdn-icons-png.flaticon.com/512/633/633652.png" width="80">
                <h5 class="mt-3">Pembayaran Digital</h5>
                <p>Dukungan QRIS & Virtual Account tanpa repot transfer manual.</p>
            </div>
        </div>
    </section>
@endsection
