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
            $table->unsignedBigInteger('user_id');
            $table->string('namaproyek');
            $table->string('deskripsi');
            $table->string('bukti');
            $table->string('pengantar')->nullable();
            $table->string('proposal')->nullable();
            $table->string('kesbangpol')->nullable();
            $table->date('tanggalmulai');
            $table->date('tanggalselesai');
            $table->enum('status', ['Diproses', 'Diteruskan', 'Ditolak', 'Diterima']);
            $table->string('komentar')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
