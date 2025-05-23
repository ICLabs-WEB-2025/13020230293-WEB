<?php
// File: app/Models/Log.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Log.php
// ... (use statements)
class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'admin_id', // Hapus ini [cite: 68]
        'user_id', // Pastikan ini ada
        'activity',
        'description',
        'ip_address', // Jika masih dipakai, tambahkan ke migrasi juga
        'user_agent'  // Jika masih dipakai, tambahkan ke migrasi juga
    ]; // [cite: 68] (dimodifikasi)

    public function user() // Ubah dari admin() [cite: 69]
    {
        return $this->belongsTo(User::class, 'user_id'); // [cite: 69] (dimodifikasi)
    }
}
