<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Classes extends Model {
    use HasFactory;
    protected $fillable = ['nama_kelas'];

    public function comments() {
        return $this->hasMany(Comment::class, 'class_id');
    }
}
