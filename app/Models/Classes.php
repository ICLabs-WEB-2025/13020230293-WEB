<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Classes extends Model {
    use HasFactory;
    protected $fillable = ['nama_kelas'];
    // Jika nama tabel Anda BUKAN 'academic_classes' (plural dari nama model), tambahkan:
    // protected $table = 'classes'; // Contoh jika tabelnya 'classes'

    public function comments() {
        return $this->hasMany(Comment::class, 'class_id');
    }
}
