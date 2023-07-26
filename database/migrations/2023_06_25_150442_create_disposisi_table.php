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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat');
            $table->unsignedBigInteger('id_user');
            $table->timestamp('tanggal_surat');
            $table->string('sifat');
            $table->string('dari');
            $table->string('ringkasan_isi');
            $table->string('catatan');
            $table->string('diteruskan_kepada')->nullable();
            $table->integer('status');
            $table->string('file');
            $table->foreign('id_surat')->references('id')->on('surat_masuk');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('disposisi');
    }
};
