<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // Pastikan ini ada

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // !!! TAMBAHKAN PENDAFTARAN ALIAS MIDDLEWARE DI SINI !!!
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            // Anda bisa menambahkan alias lain di sini jika perlu, contoh:
            // 'auth' => \App\Http\Middleware\Authenticate::class, (jika belum terdaftar otomatis oleh struktur baru)
            // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, (jika belum terdaftar otomatis)
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
