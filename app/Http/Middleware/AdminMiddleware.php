<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 🔥 FIX UTAMA: Satpam meloloskan user jika rolenya adalah 'admin' ATAU 'petugas'
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')) {
            return $next($request);
        }

        // Jika benar-benar user biasa, baru ditolak dan balikkan ke dashboard katalog
        return redirect('/dashboard')->with('error', 'Akses ditolak!');
    }
}