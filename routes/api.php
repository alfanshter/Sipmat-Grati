<?php

use App\Http\Controllers\AparController;
use App\Http\Controllers\ApatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HydrantController;
use App\Http\Controllers\KebisinganController;
use App\Http\Controllers\PencahayaanController;
use App\Http\Controllers\ScheduleAparController;
use App\Http\Controllers\ScheduleApatController;
use App\Http\Controllers\ScheduleHydrantController;
use App\Http\Controllers\ScheduleKebisinganController;
use App\Http\Controllers\SchedulePencahayaanController;
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
    Route::get('/profile', function(Request $request) {
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
    Route::get('/getschedule_hydrant/{tw?&tahun?}', [ScheduleHydrantController::class, 'getschedule']);
    Route::get('/gethasil_hydrant/{tw?&tahun?}', [ScheduleHydrantController::class, 'gethasil']);
 
    
   //Kebisingan
   Route::post('/kebisingan', [KebisinganController::class, 'store']);
   Route::get('/getkebisingan', [KebisinganController::class, 'getkebisingan']);
   Route::post('/deletekebisingan', [KebisinganController::class, 'deletekebisingan']);
   Route::post('/updatekebisingan', [KebisinganController::class, 'updatekebisingan']);

    //Schedule Kebisingan
    Route::post('/schedule_kebisingan', [ScheduleKebisinganController::class, 'insert']);
    Route::post('/update_schedule_kebisingan', [ScheduleKebisinganController::class, 'updateschedule']);
    Route::get('/getschedule_kebisingan/{tw?&tahun?}', [ScheduleKebisinganController::class, 'getschedule']);
    Route::get('/gethasil_kebisingan/{tw?&tahun?}', [ScheduleKebisinganController::class, 'gethasil']);
 
   //Pencahayaan
   Route::post('/pencahayaan', [PencahayaanController::class, 'store']);
   Route::get('/getpencahayaan', [PencahayaanController::class, 'getpencahayaan']);
   Route::post('/deletepencahayaan', [PencahayaanController::class, 'deletepencahayaan']);
   Route::post('/updatepencahayaan', [PencahayaanController::class, 'updatepencahayaan']);

    //Schedule Kebisingan
    Route::post('/schedule_pencahayaan', [SchedulePencahayaanController::class, 'insert']);
    Route::post('/update_schedule_pencahayaan', [SchedulePencahayaanController::class, 'updateschedule']);
    Route::get('/getschedule_pencahayaan/{tw?&tahun?}', [SchedulePencahayaanController::class, 'getschedule']);
    Route::get('/gethasil_pencahayaan/{tw?&tahun?}', [SchedulePencahayaanController::class, 'gethasil']);
 