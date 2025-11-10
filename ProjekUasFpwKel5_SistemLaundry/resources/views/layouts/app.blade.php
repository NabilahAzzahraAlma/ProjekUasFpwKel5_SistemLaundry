<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KangCuciExpress - @yield('title', 'Dashboard')</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            Dashboard
        </x-nav-link>

        @auth
            @if (auth()->user()->role === 'pelanggan')
                <x-nav-link :href="route('pelanggan.pesanan.index')">Pesanan</x-nav-link>
                <x-nav-link :href="route('pelanggan.komplain.index')">Komplain</x-nav-link>
            @elseif(in_array(auth()->user()->role, ['admin', 'staf']))
                <x-nav-link :href="route('admin.dashboard')">Kelola Pesanan</x-nav-link>
                <x-nav-link :href="route('admin.laporan')">Laporan</x-nav-link>
            @elseif(auth()->user()->role === 'owner')
                <x-nav-link :href="route('admin.laporan')">Laporan</x-nav-link>
                <x-nav-link :href="route('nota.generate', 1)">Invoice</x-nav-link>
            @endif
        @endauth
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">KangCuciExpress</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    {{-- Menu umum --}}
                    <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link">Pesanan</a></li>
                    <li class="nav-item"><a href="{{ route('orders.create') }}" class="nav-link">Tambah Pesanan</a></li>

                    {{-- Role-based menu --}}
                    @auth
                        @if (auth()->user()->role === 'pelanggan')
                            <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.pesanan.index') }}">Pesanan
                                    Saya</a></li>
                        @endif
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin
                                    Dashboard</a></li>
                        @endif
                        @if (auth()->user()->role === 'driver')
                            <li class="nav-item"><a class="nav-link" href="{{ route('driver.dashboard') }}">Driver
                                    Dashboard</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.komplain.index') }}">Komplain</a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item"><span class="nav-link">Hi, {{ auth()->user()->name }}</span></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <div class="container">
        {{-- Notifikasi Sukses/Error Unified --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
