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
        Schema::create('f_f_blok1s', function (Blueprint $table) {
            $table->id();
            $table->string('tw');
            $table->string('tahun');
            $table->string('hari');
            $table->date('tanggal_cek')->nullable();
            $table->string('shift')->nullable();
            $table->integer('is_status')->default(0);
            //Service Pump
            $table->string('sp_waktu_pencatatan_sebelum_start')->nullable();
            $table->string('sp_waktu_pencatatan_sesudah_start')->nullable();
            $table->string('sp_suction_press_sebelum_start')->nullable();
            $table->string('sp_suction_press_sesudah_start')->nullable();
            $table->string('sp_discharge_press_sebelum_start')->nullable();
            $table->string('sp_discharge_press_sesudah_start')->nullable();
            $table->string('sp_fuel_level_sebelum_start')->nullable();
            $table->string('sp_fuel_level_sesudah_start')->nullable();
            $table->string('sp_auto_start_sebelum_start')->nullable();
            $table->string('sp_auto_start_sesudah_start')->nullable();
            //motor drive
            $table->string('md_waktu_pencatatan_sebelum_start')->nullable();
            $table->string('md_waktu_pencatatan_sesudah_start')->nullable();
            $table->string('md_suction_press_sebelum_start')->nullable();
            $table->string('md_suction_press_sesudah_start')->nullable();
            $table->string('md_discharge_press_sebelum_start')->nullable();
            $table->string('md_discharge_press_sesudah_start')->nullable();
            $table->string('md_full_level_sebelum_start')->nullable();
            $table->string('md_full_level_sesudah_start')->nullable();
            $table->string('md_auto_start_sebelum_start')->nullable();
            $table->string('md_auto_start_sesudah_start')->nullable();

            //Diesel Engine
            $table->string('de_waktu_pencatatan_sebelum_start')->nullable();
            $table->string('de_waktu_pencatatan_sesudah_start')->nullable();
            $table->string('de_lube_oil_press_sebelum_start')->nullable();
            $table->string('de_lube_oil_press_sesudah_start')->nullable();
            $table->string('de_battery_voltage_sebelum_start')->nullable();
            $table->string('de_battery_voltage_sesudah_start')->nullable();
            $table->string('de_battery_ampere_sebelum_start')->nullable();
            $table->string('de_battery_ampere_sesudah_start')->nullable();
            $table->string('de_battery_level_sebelum_start')->nullable();
            $table->string('de_battery_level_sesudah_start')->nullable();
            $table->string('de_fuel_level_sebelum_start')->nullable();
            $table->string('de_fuel_level_sesudah_start')->nullable();
            $table->string('de_lube_oil_level_sebelum_start')->nullable();
            $table->string('de_lube_oil_level_sesudah_start')->nullable();
            $table->string('de_water_cooler_level_sebelum_start')->nullable();
            $table->string('de_water_cooler_level_sesudah_start')->nullable();
            $table->string('de_speed_sebelum_start')->nullable();
            $table->string('de_speed_sesudah_start')->nullable();
            $table->string('de_suction_press_sebelum_start')->nullable();
            $table->string('de_suction_press_sesudah_start')->nullable();
            $table->string('de_discharge_press_sebelum_start')->nullable();
            $table->string('de_discharge_press_sesudah_start')->nullable();
            $table->string('de_auto_start_sebelum_start')->nullable();
            $table->string('de_auto_start_sesudah_start')->nullable();

            $table->string('catatan')->nullable();
            //personal
            $table->string('k3_nama')->nullable();
            $table->string('k3_ttd')->nullable();
            $table->string('operator_nama')->nullable();
            $table->string('operator_ttd')->nullable();
            $table->string('supervisor_nama')->nullable();
            $table->string('supervisor_ttd')->nullable();

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
        Schema::dropIfExists('f_f_blok1s');
    }
};
