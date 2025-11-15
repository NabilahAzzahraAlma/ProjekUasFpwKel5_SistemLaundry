<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::check() && auth()->user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }


            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        // Phone & address di comment dulu karena di database & file migration gaada kolom phone
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            // 'phone'    => 'required|string|max:255',
            // 'address'    => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            // 'phone'    => $data['phone'],
            // 'address'    => $data['address'],
            'password' => Hash::make($data['password']),
            'role'     => 'pelanggan',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

   public function logout(Request $request)
{
    // keluarin user dari auth
    \Illuminate\Support\Facades\Auth::logout();

    // putuskan session biar aman
    $request->session()->invalidate();

    // bikin ulang token CSRF
    $request->session()->regenerateToken();

    // lempar balik ke halaman login
    return redirect('/login');
}

}
