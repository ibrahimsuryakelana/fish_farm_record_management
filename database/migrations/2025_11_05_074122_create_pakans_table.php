<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void //test
    {
        Schema::create('pakans', function (Blueprint $table) {
            $table->id('id_pakan');
            $table->date('tanggal_pakan_masuk');
            $table->integer('jumlah_pakan')->default(0); // jumlah bal/karung masuk
            $table->bigInteger('harga_per_bal')->default(0);
            $table->integer('stok')->default(0); // stok yang tersedia (bal/karung)
            $table->timestamps();
        });
    } //test

    public function down(): void
    {
        Schema::dropIfExists('pakans');
    }
}; //test
