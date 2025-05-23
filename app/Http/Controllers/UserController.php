<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function dashboard()
    {

        if (Auth::user()->role === 'admin') {

        }
        // Default fallback jika tidak ada view user.dashboard
        return redirect()->route('landing')->with('info', 'Dashboard user belum tersedia.');
    }



}
