<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Log;

class AuthController extends Controller{
    public function showLoginForm(){
        return redirect()->route('landing');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('rememberMe');

        // --- MULAI DEBUGGING QUERY ---
        DB::enableQueryLog(); // Aktifkan pencatatan query

        $attemptResult = Auth::attempt($credentials, $remember); // Lakukan percobaan login

        $queries = DB::getQueryLog();
        DB::disableQueryLog();
        if ($attemptResult) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (!$user) {
                Auth::logout();
                return back()->withErrors(['email' => 'Terjadi kesalahan sistem saat mengambil data pengguna.'])->onlyInput('email');
            }

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Akses ditolak. Hanya admin.'])->onlyInput('email');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing')->with('status', 'Anda telah logout.');
    }
}
