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
        Schema::create('schedule_pencahayaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pencahayaan');
            $table->foreign('kode_pencahayaan')->references('kode')->on('pencahayaans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tw');
            $table->string('tahun');
            $table->date('tanggal_cek');
            $table->integer('is_status')->default(0);
            $table->string('shift')->nullable();
            $table->integer('lux1')->nullable();
            $table->integer('lux2')->nullable();
            $table->integer('lux3')->nullable();
            $table->float('luxrata2')->nullable();
            $table->integer('nilai_minimum_lux')->nullable();
            $table->string('sumber_pencahayaan')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('schedule_pencahayaans');
    }
};
