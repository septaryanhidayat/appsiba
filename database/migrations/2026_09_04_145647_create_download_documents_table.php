<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('download_documents', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Umum');
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->string('nama_file');
            $table->string('tipe_file', 20)->default('pdf');
            $table->string('ukuran_file', 50)->nullable();
            $table->unsignedInteger('jumlah_unduhan')->default(0);
            $table->boolean('is_aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_documents');
    }
};
