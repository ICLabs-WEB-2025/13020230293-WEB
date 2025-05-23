<?php
// File: app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   // app/Http/Middleware/AdminMiddleware.php
public function handle(Request $request, Closure $next)
{
    if (Auth::check() && Auth::user()->role === 'admin') { // [cite: 55]
        return $next($request); // [cite: 55]
    }

    // Auth::logout(); // Opsional: logout user jika mencoba akses tanpa hak
    // return redirect()->route('login')->with('error', 'Akses ditolak. Anda bukan admin.');
    return abort(403, 'AKSES DITOLAK. ANDA BUKAN ADMIN.'); // Lebih standar untuk authorization failure
}
}
