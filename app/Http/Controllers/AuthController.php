<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form register
    public function register()
    {
        return view('auth.register'); // [cite: 1660]
    }

    // Memproses data register
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password', // [cite: 1673-1676]
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Enkripsi password
            'role' => 'customer' // Default role saat register baru
        ]);

        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil, silakan login!'); // [cite: 1682]
    }

    // Menampilkan form login
    public function login()
    {
        return view('auth.login'); // [cite: 1669]
    }

    // Memproses login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); // [cite: 1684-1687]

        if (Auth::attempt($credentials)) { // [cite: 1688]
            $request->session()->regenerate(); // [cite: 1689]
            return redirect()->intended('dashboard'); // [cite: 1690]
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.', // [cite: 1692]
        ])->onlyInput('email'); // [cite: 1692]
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout(); // [cite: 1693]
        $request->session()->invalidate(); // [cite: 1694]
        $request->session()->regenerateToken(); // [cite: 1695]
        return redirect()->route('auth.login'); // [cite: 1696]
    }
}