<?php

use App\Http\Controllers\AparController;
use App\Http\Controllers\ApatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleAparController;
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

   //APAR
   Route::post('/apat', [ApatController::class, 'store']);
