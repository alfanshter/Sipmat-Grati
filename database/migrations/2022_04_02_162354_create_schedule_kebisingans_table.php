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
            $table->integer('is_status')->default(0);
            $table->integer('dbx1')->nullable();
            $table->integer('dbx2')->nullable();
            $table->integer('dbx3')->nullable();
            $table->integer('dbrata2')->nullable();
            $table->integer('nab_kebisingan')->nullable();
            $table->integer('keterangan')->nullable();
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
