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
        Schema::create('logistic_requests', function (Blueprint $table) {
            $table->id();

            // Relasi antar tabel
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_logistik')->constrained('logistics')->onDelete('cascade');
            $table->foreignId('id_inlogistik')->nullable()->constrained('inlogistics')->onDelete('cascade');
            $table->foreignId('id_outlogistik')->nullable()->constrained('outlogistics')->onDelete('cascade');

            // Kolom perhitungan rekomendasi stok
            $table->integer('stok_saat_ini')->default(0);
            $table->integer('rata_bulanan')->default(0);
            $table->integer('rekomendasi_tahunan')->default(0);

            // Status hasil perhitungan
            $table->enum('status', ['Aman', 'Perlu Pengadaan'])->default('Aman');

            // Tahun rekomendasi (misal: 2025, 2026, dst)
            $table->year('tahun_rekomendasi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistic_requests');
    }
};
