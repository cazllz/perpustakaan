<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetugasMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah yang login rolenya petugas atau admin
        if (auth()->check() && (auth()->user()->role == 'petugas' || auth()->user()->role == 'admin')) {
            return $next($request);
        }

        // Kalau bukan petugas, balikkan ke dashboard user
        return redirect('/dashboard')->with('error', 'Akses khusus petugas!');
    }
}