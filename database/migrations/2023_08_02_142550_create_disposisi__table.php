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
            $table->unsignedBigInteger('id_bidang');
            $table->timestamp('tanggal_disposisi')->useCurrent();
            $table->string('catatan');
            $table->foreign('id_surat')->references('id')->on('surat_masuk');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_bidang')->references('id')->on('bidang');
            $table->timestamp('tanggal_penyelesaian')->useCurrent();
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
