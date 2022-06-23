<?php

use App\Http\Controllers\AparController;
use App\Http\Controllers\ApatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FFblok1Controller;
use App\Http\Controllers\HydrantController;
use App\Http\Controllers\KebisinganController;
use App\Http\Controllers\PencahayaanController;
use App\Http\Controllers\ScheduleAparController;
use App\Http\Controllers\ScheduleApatController;
use App\Http\Controllers\ScheduleHydrantController;
use App\Http\Controllers\ScheduleKebisinganController;
use App\Http\Controllers\SchedulePencahayaanController;
use App\Http\Controllers\SeaWaterController;
use App\Models\ScheduleApar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);


Route::get('/getusers/{role?}', [AuthController::class, 'getusers']);



//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
});

// API route for logout user
Route::post('/logout', [AuthController::class, 'logout']);
//APAR
Route::post('/apar', [AparController::class, 'store']);
Route::get('/apar', [AparController::class, 'index']);
Route::post('/deleteapar', [AparController::class, 'deleteapar']);
Route::post('/updateapar', [AparController::class, 'updateapar']);
Route::get('/cekapar/{kode?}', [AparController::class, 'cekapar']);
Route::get('/apar_kadaluarsa', [AparController::class, 'apar_kadaluarsa']);
Route::post('/apar_pdf', [AparController::class, 'apar_pdf']);

//Schedule
Route::post('/schedule_apar', [ScheduleAparController::class, 'store']);
Route::get('/getschedule/{tw?&tahun?}', [ScheduleAparController::class, 'getschedule']);
Route::get('/gethasil/{tw?&tahun?}', [ScheduleAparController::class, 'gethasil']);
Route::get('/getschedule_pelaksana', [ScheduleAparController::class, 'getschedule_pelaksana']);
Route::post('/update_schedule_apar', [ScheduleAparController::class, 'updateschedule']);
Route::post('/acc_apar', [ScheduleAparController::class, 'acc_apar']);
Route::post('/return_apar', [ScheduleAparController::class, 'return_apar']);
Route::post('/hapus_schedule_apar', [ScheduleAparController::class, 'hapus_schedule_apar']);

//APAT
Route::post('/apat', [ApatController::class, 'store']);
Route::get('/getapat', [ApatController::class, 'getapat']);
Route::post('/deleteapat', [ApatController::class, 'deleteapat']);
Route::post('/updateapat', [ApatController::class, 'updateapat']);
Route::get('/cekapat/{kode?}', [ApatController::class, 'cekapat']);

//Schedule APAT
Route::post('/schedule_apat', [ScheduleApatController::class, 'insert']);
Route::post('/update_schedule_apat', [ScheduleApatController::class, 'updateschedule']);
Route::post('/hapus_schedule_apat', [ScheduleApatController::class, 'hapus_schedule_apat']);
Route::get('/getschedule_apat/{tw?&tahun?}', [ScheduleApatController::class, 'getschedule']);
Route::get('/gethasil_apat/{tw?&tahun?}', [ScheduleApatController::class, 'gethasil']);
Route::get('/getschedule_pelaksana_apat', [ScheduleApatController::class, 'getschedule_pelaksana_apat']);
Route::post('/acc_apat', [ScheduleApatController::class, 'acc_apat']);
Route::post('/return_apat', [ScheduleApatController::class, 'return_apat']);
Route::post('/apat_pdf', [ScheduleApatController::class, 'apat_pdf']);

//Hydrant
Route::post('/hydrant', [HydrantController::class, 'store']);
Route::get('/gethydrant', [HydrantController::class, 'gethydrant']);
Route::post('/deletehydrant', [HydrantController::class, 'deletehydrant']);
Route::post('/updatehydrant', [HydrantController::class, 'updatehydrant']);


//Schedule Hydrant
Route::post('/schedule_hydrant', [ScheduleHydrantController::class, 'insert']);
Route::post('/update_schedule_hydrant', [ScheduleHydrantController::class, 'updateschedule']);
Route::post('/hapus_schedule_hydrant', [ScheduleHydrantController::class, 'hapus_schedule_hydrant']);
Route::get('/getschedule_hydrant/{tw?&tahun?}', [ScheduleHydrantController::class, 'getschedule']);
Route::get('/gethasil_hydrant/{tw?&tahun?}', [ScheduleHydrantController::class, 'gethasil']);
Route::get('/getschedule_pelaksana_hydrant', [ScheduleHydrantController::class, 'getschedule_pelaksana_hydrant']);
Route::post('/acc_hydrant', [ScheduleHydrantController::class, 'acc_hydrant']);
Route::post('/return_hydrant', [ScheduleHydrantController::class, 'return_hydrant']);
Route::post('/hydrant_pdf', [ScheduleHydrantController::class, 'hydrant_pdf']);


//Kebisingan
Route::post('/kebisingan', [KebisinganController::class, 'store']);
Route::get('/getkebisingan', [KebisinganController::class, 'getkebisingan']);
Route::post('/deletekebisingan', [KebisinganController::class, 'deletekebisingan']);
Route::post('/updatekebisingan', [KebisinganController::class, 'updatekebisingan']);

//Schedule Kebisingan
Route::post('/schedule_kebisingan', [ScheduleKebisinganController::class, 'insert']);
Route::post('/update_schedule_kebisingan', [ScheduleKebisinganController::class, 'updateschedule']);
Route::post('/hapus_schedule_kebisingan', [ScheduleKebisinganController::class, 'hapus_schedule']);
Route::get('/getschedule_kebisingan/{tw?&tahun?}', [ScheduleKebisinganController::class, 'getschedule']);
Route::get('/gethasil_kebisingan/{tw?&tahun?}', [ScheduleKebisinganController::class, 'gethasil']);
Route::post('/acc_kebisingan', [ScheduleKebisinganController::class, 'acc_kebisingan']);
Route::post('/return_kebisingan', [ScheduleKebisinganController::class, 'return_kebisingan']);
Route::get('/getschedule_pelaksana_kebisingan', [ScheduleKebisinganController::class, 'getschedule_pelaksana_kebisingan']);
Route::post('/kebisingan_pdf', [ScheduleKebisinganController::class, 'kebisingan_pdf']);

//Pencahayaan
Route::post('/pencahayaan', [PencahayaanController::class, 'store']);
Route::get('/getpencahayaan', [PencahayaanController::class, 'getpencahayaan']);
Route::post('/deletepencahayaan', [PencahayaanController::class, 'deletepencahayaan']);
Route::post('/updatepencahayaan', [PencahayaanController::class, 'updatepencahayaan']);

//Schedule Pencahayaan
Route::post('/schedule_pencahayaan', [SchedulePencahayaanController::class, 'insert']);
Route::post('/update_schedule_pencahayaan', [SchedulePencahayaanController::class, 'updateschedule']);
Route::get('/getschedule_pencahayaan/{tw?&tahun?}', [SchedulePencahayaanController::class, 'getschedule']);
Route::get('/gethasil_pencahayaan/{tw?&tahun?}', [SchedulePencahayaanController::class, 'gethasil']);
Route::post('/hapus_schedule_pencahayaan', [SchedulePencahayaanController::class, 'hapus_schedule']);
Route::post('/return_pencahayaan', [SchedulePencahayaanController::class, 'return_pencahayaan']);
Route::post('/acc_pencahayaan', [SchedulePencahayaanController::class, 'acc_pencahayaan']);
Route::post('/pencahayaan_pdf', [SchedulePencahayaanController::class, 'pencahayaan_pdf']);
Route::get('/getschedule_pelaksana_pencahayaan', [SchedulePencahayaanController::class, 'getschedule_pelaksana_pencahayaan']);

//SewaWater
Route::post('/seawater', [SeaWaterController::class, 'insert_seawater']);
Route::post('/update_seawater', [SeaWaterController::class, 'update_seawater']);
Route::get('/seawater/{tw?&tahun>}', [SeaWaterController::class, 'get_seawater']);
Route::post('/hapus_seawater', [SeaWaterController::class, 'hapus_seawater']);
Route::get('/seawater_pelaksana', [SeaWaterController::class, 'seawater_pelaksana']);
Route::post('/return_seawater', [SeaWaterController::class, 'return_seawater']);
Route::post('/acc_seawater', [SeaWaterController::class, 'acc_seawater']);
Route::post('/seawater_pdf', [SeaWaterController::class, 'seawater_pdf']);

//FFBLOK1
Route::post('/ffblok', [FFblok1Controller::class, 'insert_ffblok']);
Route::post('/update_ffblok', [FFblok1Controller::class, 'update_ffblok']);
Route::get('/ffblok/{tw?&tahun>}', [FFblok1Controller::class, 'get_ffblok']);
Route::post('/hapus_ffblok', [FFblok1Controller::class, 'hapus_ffblok']);
Route::get('/ffblok_pelaksana', [FFblok1Controller::class, 'ffblok_pelaksana']);
Route::post('/return_ffblok', [FFblok1Controller::class, 'return_ffblok']);
Route::post('/acc_ffblok', [FFblok1Controller::class, 'acc_ffblok']);
Route::post('/ffblok_pdf', [FFblok1Controller::class, 'ffblok_pdf']);
