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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
        $table->string('reporter_name');    // Nama Pelapor
        $table->string('title');            // Judul Laporan
        $table->text('description');        // Isi Laporan
        $table->string('image_path')->nullable(); // Bukti Foto (URL)
        $table->enum('status', ['pending', 'process', 'done'])->default('pending');
        $table->text('admin_response')->nullable(); // Balasan Admin
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
