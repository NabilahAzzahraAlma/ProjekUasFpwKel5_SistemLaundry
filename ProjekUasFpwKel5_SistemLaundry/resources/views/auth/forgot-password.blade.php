<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | Laundry App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* ====== GLOBAL LAYOUT (bg hijau daun + center) ====== */
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

        /* ====== CARD UTAMA (dipakai lupa password) ====== */
        .login-container {
            background: white;
            width: 360px;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* judul di dalam card */
        .login-container h1 {
            margin-bottom: 25px;
            color: #388e3c; /* Hijau daun */
            font-size: 1.6em;
            font-weight: 600;
        }

        /* ====== FORM ELEMENTS ====== */
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

        input[type="email"] {
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

        /* ====== BUTTON UTAMA ====== */
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

        /* ====== LINK DI BAWAH FORM ====== */
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
        <h1>Lupa Password</h1>
        <p style="margin-top:-10px; margin-bottom:20px; color:#666; font-size:0.9rem;">
            Masukkan email yang terdaftar. Kami akan kirim link reset password.
        </p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label>Email Anda</label>
                <input type="email" name="email" placeholder="Masukkan email" required autofocus>
            </div>

            <button type="submit">Kirim Link Reset Password</button>

            <div class="register-link" style="margin-top:16px;">
                <a href="{{ route('login') }}">⬅ Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>
