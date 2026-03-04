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
                Schema::create('prodis', function (Blueprint $table) {
            $table->id();

            // IDENTITAS PRODI
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('header_title');

            // ================= SEJARAH =================
            $table->string('sejarah_title')->nullable();
            $table->longText('sejarah_content')->nullable();
            $table->string('sejarah_image')->nullable();

            // ================= KAPRODI =================
            $table->string('kaprodi_name')->nullable();
            $table->string('kaprodi_nip')->nullable();
            $table->string('kaprodi_nidn')->nullable();
            $table->string('kaprodi_photo')->nullable();

            // ================= VISI MISI =================
            $table->text('visi')->nullable();

            // ================= TUJUAN =================
            $table->longText('tujuan')->nullable();

            // ================= SASARAN =================
            $table->text('sasaran')->nullable();

            // ================= KURIKULUM =================
            $table->string('kurikulum_title')->nullable();
            $table->longText('kurikulum_content')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
