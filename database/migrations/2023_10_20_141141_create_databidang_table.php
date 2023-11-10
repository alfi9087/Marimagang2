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
        Schema::create('databidang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('thumbnail')->nullable();
            $table->string('photo')->nullable();
            $table->string('deskripsi')->nullable();
            $table->enum('status', ['Buka', 'Tutup']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('databidang');
    }
};
