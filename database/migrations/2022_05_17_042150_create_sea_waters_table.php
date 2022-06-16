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
        Schema::create('sea_waters', function (Blueprint $table) {
            $table->id();
            $table->string('tw');
            $table->string('tahun');
            $table->string('hari');
            $table->date('tanggal_cek')->nullable();
            $table->string('shift')->nullable();
            $table->integer('is_status')->default(0);
            //motor drive
            $table->string('md_waktu_pencatatan_sebelum_start')->nullable();
            $table->string('md_waktu_pencatatan_sesudah_start')->nullable();
            $table->string('md_discharge_press_sebelum_start')->nullable();
            $table->string('md_discharge_press_sesudah_start')->nullable();
            $table->string('md_full_level_sebelum_start')->nullable();
            $table->string('md_full_level_sesudah_start')->nullable();
            //Diesel Engine
            $table->string('de_waktu_pencatatan_sebelum_start')->nullable();
            $table->string('de_waktu_pencatatan_sesudah_start')->nullable();
            $table->string('de_engine_operating_hours_sebelum_start')->nullable();
            $table->string('de_engine_operating_hours_sesudah_start')->nullable();
            $table->string('de_battery_voltage_sebelum_start')->nullable();
            $table->string('de_battery_voltage_sesudah_start')->nullable();
            $table->string('de_battery_ampere_sebelum_start')->nullable();
            $table->string('de_battery_ampere_sesudah_start')->nullable();
            $table->string('de_battery_level_sebelum_start')->nullable();
            $table->string('de_battery_level_sesudah_start')->nullable();
            $table->string('de_fuel_level_sebelum_start')->nullable();
            $table->string('de_fuel_level_sesudah_start')->nullable();
            $table->string('de_crankcase_sebelum_start')->nullable();
            $table->string('de_crankcase_sesudah_start')->nullable();
            $table->string('de_engine_coolant_tank_sebelum_start')->nullable();
            $table->string('de_engine_coolant_tank_sesudah_start')->nullable();
            $table->string('de_cooling_water_inlet_valve_sebelum_start')->nullable();
            $table->string('de_cooling_water_inlet_valve_sesudah_start')->nullable();
            $table->string('de_oil_pressure_sebelum_start')->nullable();
            $table->string('de_oil_pressure_sesudah_start')->nullable();
            $table->string('de_cooling_water_pressure_after_regulator_sebelum_start')->nullable();
            $table->string('de_cooling_water_pressure_after_regulator_sesudah_start')->nullable();
            $table->string('de_coolant_temperature_sebelum_start')->nullable();
            $table->string('de_coolant_temperature_sesudah_start')->nullable();
            $table->string('de_speed_sebelum_start')->nullable();
            $table->string('de_speed_sesudah_start')->nullable();
            $table->string('de_suction_press_sebelum_start')->nullable();
            $table->string('de_suction_press_sesudah_start')->nullable();
            $table->string('de_discharge_press_sebelum_start')->nullable();
            $table->string('de_discharge_press_sesudah_start')->nullable();
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
        Schema::dropIfExists('sea_waters');
    }
};
