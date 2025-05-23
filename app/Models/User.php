<?php

// File: app/Models/User.php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash; // Pastikan Hash di-import jika belum

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <-- TAMBAHKAN 'role' DI SINI
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array // Jika Anda menggunakan Laravel 9+
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // [cite: 88]
        ];
    }

    // Untuk Laravel versi lama yang tidak menggunakan method casts():
    // protected $casts = [
    // 'email_verified_at' => 'datetime',
    // ];
    //
    // public function setPasswordAttribute($value)
    // {
    // $this->attributes['password'] = Hash::make($value);
    // }
}
