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
        Schema::create('schedule_apats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_apat');
            $table->foreign('kode_apat')->references('kode')->on('apats')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tw');
            $table->string('tahun');
            $table->date('tanggal_cek');
            $table->integer('is_status')->default(0);
            $table->string('shift')->nullable();
            $table->string('bak')->nullable();
            $table->string('pasir')->nullable();
            $table->string('karung')->nullable();
            $table->string('ember')->nullable();
            $table->string('sekop')->nullable();
            $table->string('gantungan')->nullable();
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
        Schema::dropIfExists('schedule_apats');
    }
};