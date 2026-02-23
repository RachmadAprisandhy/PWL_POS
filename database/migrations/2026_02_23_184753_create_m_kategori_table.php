<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('m_kategori', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('kode_kategori', 10)->unique();
            $table->string('nama_kategori', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('m_kategori');
    }
};
