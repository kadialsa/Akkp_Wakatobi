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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();

            // informasi utama
            $table->string('title'); // judul berita
            $table->string('slug')->unique(); // url slug

            // kategori berita (Akademik, Kemahasiswaan, dll)
            $table->string('category', 100)->nullable();

            // isi berita
            $table->text('excerpt')->nullable(); // ringkasan
            $table->longText('content'); // isi lengkap berita

            // media
            $table->string('image')->nullable(); // gambar utama berita

            // informasi tambahan
            $table->date('published_at')->nullable(); // tanggal publish
            $table->enum('status', ['draft', 'publish'])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
