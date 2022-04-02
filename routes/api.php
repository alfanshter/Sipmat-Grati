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
   //Schedule
   Route::post('/schedule_apar', [ScheduleAparController::class, 'store']);
   Route::get('/getschedule/{tw?&tahun?}', [ScheduleAparController::class, 'getschedule']);
   Route::get('/gethasil/{tw?&tahun?}', [ScheduleAparController::class, 'gethasil']);
   Route::post('/update_schedule_apar', [ScheduleAparController::class, 'updateschedule']);

   //APAT
   Route::post('/apat', [ApatController::class, 'store']);
   Route::get('/getapat', [ApatController::class, 'getapat']);
   Route::post('/deleteapat', [ApatController::class, 'deleteapat']);
   Route::post('/updateapat', [ApatController::class, 'updateapat']);

    //Schedule APAT
   Route::post('/schedule_apat', [ScheduleApatController::class, 'insert']);
   Route::post('/update_schedule_apat', [ScheduleApatController::class, 'updateschedule']);
   Route::get('/getschedule_apat/{tw?&tahun?}', [ScheduleApatController::class, 'getschedule']);
   Route::get('/gethasil_apat/{tw?&tahun?}', [ScheduleApatController::class, 'gethasil']);

   
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
