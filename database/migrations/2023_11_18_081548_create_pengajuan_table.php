<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('databidang_id')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('bukti')->nullable();
            $table->string('pengantar')->nullable();
            $table->string('proposal')->nullable();
            $table->string('kesbangpol')->nullable();
            $table->string('laporan')->nullable();
            $table->string('suratmagang')->nullable();
            $table->date('tanggalmulai')->nullable();
            $table->date('tanggalselesai')->nullable();
            $table->enum('status', ['Diproses', 'Diteruskan', 'Diterima', 'Ditolak', 'Magang', 'Selesai']);
            $table->string('komentar')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->string('kesediaan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('databidang_id')->references('id')->on('databidang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
};
