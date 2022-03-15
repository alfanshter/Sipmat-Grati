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
            $table->integer('is_status')->default(0);
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
