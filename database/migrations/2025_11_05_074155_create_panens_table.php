<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panens', function (Blueprint $table) {
            $table->id('id_panen');
            $table->unsignedBigInteger('id_kolam');
            $table->date('tanggal_panen');
            $table->integer('jumlah_pakan_total')->default(0);
            $table->integer('hasil_panen_kg')->default(0);
            $table->bigInteger('harga_jual_per_kg')->default(0);
            $table->bigInteger('total_penjualan')->nullable();
            $table->bigInteger('total_modal')->default(0);
            $table->bigInteger('keuntungan')->nullable();
            $table->timestamps();

            $table->foreign('id_kolam')->references('id_kolam')->on('kolam_ikans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
