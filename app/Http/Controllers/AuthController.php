<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            // 🔥 FIX 419: Menyegarkan session ID baru setelah autentikasi sukses
            $request->session()->regenerate();

            $user = auth()->user();

            // 🔥 CEK ROLE & ARAHKAN KE DASHBOARD MASING-MASING
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($user->role === 'petugas') {
                return redirect('/petugas/dashboard');
            }

            // Default untuk user biasa
            return redirect('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // ================= REGISTER =================
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'alamat' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'role' => 'user' // 🔥 default user
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar!');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        // 🔥 STABILIZER: Hancurkan session token lama saat keluar agar tidak bentrok pas mau masuk lagi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}