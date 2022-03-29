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
        Schema::create('schedule_apars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_apar');
            $table->foreign('kode_apar')->references('kode')->on('apars')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tw');
            $table->string('tahun');
            $table->date('tanggal_cek');
            $table->integer('is_status')->default(0);
            $table->string('shift')->nullable();
            $table->string('kap')->nullable();
            $table->integer('tabung')->nullable();
            $table->integer('pin')->nullable();
            $table->integer('segel')->nullable();
            $table->integer('tuas')->nullable();
            $table->integer('pressure')->nullable();
            $table->integer('selang')->nullable();
            $table->integer('nozzle')->nullable();
            $table->integer('rambu')->nullable();
            $table->integer('gantungan')->nullable();
            $table->integer('houskeeping')->nullable();
            $table->integer('keterangan_tambahan')->nullable();
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
        Schema::dropIfExists('schedule_apars');
    }
};
