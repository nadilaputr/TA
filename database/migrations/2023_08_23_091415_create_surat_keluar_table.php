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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bidang');
            $table->string('nomor_surat')->unique();
            $table->string('sifat');
            $table->string('lampiran');
            $table->string('alamat_surat');
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->smallInteger('status')->default(0);
            $table->integer('catatan');
            $table->foreign('id_bidang')->references('id')->on('bidang');
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
        Schema::dropIfExists('surat_keluar');
    }
};
