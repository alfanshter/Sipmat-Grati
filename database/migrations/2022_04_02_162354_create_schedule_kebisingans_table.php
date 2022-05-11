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
        Schema::create('schedule_kebisingans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kebisingan');
            $table->foreign('kode_kebisingan')->references('kode')->on('kebisingans')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tw');
            $table->string('tahun');
            $table->date('tanggal_cek');
            $table->string('shift')->nullable();
            $table->integer('is_status')->default(0);
            $table->string('status')->nullable();
            $table->string('dbx1')->nullable();
            $table->string('dbx2')->nullable();
            $table->string('dbx3')->nullable();
            $table->string('dbrata2')->nullable();
            $table->string('nab_kebisingan')->nullable();
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
        Schema::dropIfExists('schedule_kebisingans');
    }
};