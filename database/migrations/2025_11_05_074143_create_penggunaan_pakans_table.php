<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penggunaan_pakans', function (Blueprint $table) {
            $table->id('id_penggunaan');
            $table->unsignedBigInteger('id_kolam');
            $table->unsignedBigInteger('id_pakan')->nullable();
            $table->date('tanggal');
            $table->integer('jumlah_pakan')->default(0); // jumlah yang dipakai (bal/karung)
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_kolam')->references('id_kolam')->on('kolam_ikans')->onDelete('cascade');
            $table->foreign('id_pakan')->references('id_pakan')->on('pakans')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan_pakans');
    }
};
