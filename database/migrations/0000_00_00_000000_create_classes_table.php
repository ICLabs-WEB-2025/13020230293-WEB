<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('academic_classes', function (Blueprint $table) { // GANTI 'academic_classes' jika nama tabel Anda 'classes'
            $table->id();
            $table->string('nama_kelas')->unique();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('academic_classes'); 
    }
};
