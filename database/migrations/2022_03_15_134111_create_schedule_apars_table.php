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
            $table->string('tabung')->nullable();
            $table->string('pin')->nullable();
            $table->string('segel')->nullable();
            $table->string('tuas')->nullable();
            $table->string('pressure')->nullable();
            $table->string('selang')->nullable();
            $table->string('nozzle')->nullable();
            $table->string('rambu')->nullable();
            $table->string('handle')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->string('gantungan')->nullable();
            $table->string('houskeeping')->nullable();
            $table->string('keterangan_tambahan')->nullable();
            $table->date('tanggal_pemeriksa')->nullable();
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