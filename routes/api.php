<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\ConsultingController;
use App\Http\Controllers\ExpDayController;
use App\Http\Controllers\ExperinceController;
use App\Models\ExpDay;
use App\Models\Experince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user', [UserController::class, 'storeWallet']);
    Route::post('user/update', [UserController::class, 'updateWallet']);
    Route::post('expday/add', [ExpDayController::class, 'store']);
    Route::post('addExperince', [ExperinceController::class, 'store']);
    Route::post('addConsulting', [ExpConsultingController::class, 'store']);
    Route::post('upload_image',[UserController::class,'uploadImg']);
    Route::post('addresses',[AddressesController::class,'store']);
});
 // Route::post('user', [UserController::class, 'store']);
  Route::post('consulting', [ConsultingController::class, 'store']);

  Route::post('deleteUser',[AuthController::class, 'deleteUser']);
  Route::get('getAllConsulting',[ConsultingController::class,'getAllConsulting']);





