<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Laundry App</title>
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

        .login-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            max-width: 1200px;
        }

        /* ====== LOGIN FORM STYLING ====== */
        .login-container {
            background: white;
            width: 45%;
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

        input[type="email"],
        input[type="password"] {
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

        /* ====== ACTIONS AND BUTTON ====== */
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

        /* ====== Gambar Styling ====== */
        .image-container {
            width: 45%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            max-width: 100%; /* Membatasi lebar gambar agar pas dengan ukuran container */
            height: auto; /* Menjaga rasio gambar tetap proporsional */
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                width: 90%;
            }
            .login-container, .image-container {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Login Form -->
        <div class="login-container">
            <h1>Login Laundry App</h1>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Masukkan email" required autofocus>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <div class="actions">
                    <label>
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </div>

                <button type="submit">Masuk</button>

                <div class="register-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </form>
        </div>

        <!-- Image Container -->
        <div class="image-container">
            <img src="{{ asset('img/login view.jpg') }}" alt="Laundry Image">
        </div>
    </div>
</body>
</html>
