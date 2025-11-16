<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Laundry App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* === STYLE REGISTER PAGE === */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #388e3c, #81c784); /* Hijau daun gradient */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            width: 360px;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 25px;
            color: #388e3c; /* Hijau daun */
            font-size: 1.6em;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 0.9em;
            color: #333;
            margin-bottom: 6px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1em;
        }

        input:focus {
            outline: none;
            border-color: #388e3c; /* Hijau daun */
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -8px;
            margin-bottom: 15px;
        }

        .actions a {
            font-size: 0.85em;
            color: #388e3c; /* Hijau daun */
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        button {
            background-color: #fbc02d; /* Kuning */
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 0;
            width: 100%;
            font-size: 1em;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #f9a825; /* Kuning lebih gelap */
        }

        .register-link {
            margin-top: 20px;
            font-size: 0.9em;
        }

        .register-link a {
            color: #388e3c; /* Hijau daun */
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error {
            background: #ffcdd2;
            color: #b71c1c;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Buat Akun Laundry</h1>
        <p style="margin-top:-10px; margin-bottom:20px; color:#666; font-size:0.9rem;">
            Daftarkan akun baru untuk menggunakan layanan Laundry App.
        </p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama lengkap" required autofocus>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="phone" placeholder="Masukkan nomor telepon" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="address" placeholder="Masukkan alamat" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
            </div>

            <button type="submit">Daftar Akun</button>

            <div class="register-link" style="margin-top:16px;">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk sekarang</a>
            </div>
        </form>
    </div>
</body>
</html>
