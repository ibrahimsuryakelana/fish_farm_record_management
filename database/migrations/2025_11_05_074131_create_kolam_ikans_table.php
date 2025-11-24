<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kolam_ikans', function (Blueprint $table) {
            $table->id('id_kolam'); //specialkey
            $table->date('tanggal_tanam')->nullable();
            $table->string('no_kolam');
            $table->integer('jumlah_ikan')->default(0);
            $table->string('ukuran_ikan')->nullable();
            $table->integer('jumlah_pakan_dalam_1_bulan')->nullable();
            $table->integer('harga_kg')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kolam_ikans');
    }
};
