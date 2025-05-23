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
        'user_id',
        'activity',
        'description',
        'ip_address',
        'user_agent'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id'); // [cite: 69] (dimodifikasi)
    }
}
