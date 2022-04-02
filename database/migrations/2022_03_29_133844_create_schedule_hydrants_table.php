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
        Schema::create('schedule_hydrants', function (Blueprint $table) {
            $table->id();
            $table->string('kode_hydrant');
            $table->foreign('kode_hydrant')->references('kode')->on('hydrants')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tw');
            $table->string('tahun');
            $table->date('tanggal_cek');
            $table->integer('is_status')->default(0);
            $table->string('shift')->nullable();
            $table->integer('flushing')->nullable();
            $table->integer('main_valve')->nullable();
            $table->integer('discharge')->nullable();
            $table->integer('kondisi_box')->nullable();
            $table->integer('kunci_box')->nullable();
            $table->integer('kunci_f')->nullable();
            $table->integer('selang')->nullable();
            $table->integer('noozle')->nullable();
            $table->integer('house_keeping')->nullable();
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
        Schema::dropIfExists('schedule_hydrants');
    }
};
