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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id('id_experience'); // Primary Key
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('posisi'); // jabatan
            $table->string('perusahaan'); // nama perusahaan
            $table->year('tahun_mulai'); // mulai
            $table->year('tahun_selesai')->nullable(); // selesai (boleh kosong)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};