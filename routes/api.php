<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\ConsultingController;
use App\Http\Controllers\ExpDayController;
use App\Http\Controllers\ExperinceController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\UserDateController;
use App\Models\ExpDay;
use App\Models\Experince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpConsultingController;
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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['middleware' => 'expert'], function () {
        Route::post('addexperince', [ExperinceController::class, 'store']);

    }
    );

    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('user', [UserController::class, 'storeWallet']);
    Route::post('user/update', [UserController::class, 'updateWallet']);
    Route::post('upload_image', [UserController::class, 'uploadImg']);
    Route::post('userdate', [UserDateController::class, 'store']);
    Route::get('reservation', [UserDateController::class, 'reservation']);


    Route::post('expday/add', [ExpDayController::class, 'store']);
    Route::get('expday/add', [ExpDayController::class, 'show']);

    Route::get('getexperince', [ExperinceController::class, 'show']);
        Route::get('info', [ExperinceController::class, 'showinfo']);



    Route::post('addConsulting', [ExpConsultingController::class, 'store']);
    Route::get('getExperts', [ExpConsultingController::class, 'getExperts']);


    Route::post('addresses', [AddressesController::class, 'store']);
    Route::get('getaddress', [AddressesController::class, 'show']);

    Route::get('getcons', [ConsultingController::class, 'getExperts']);
    Route::post('consulting', [ConsultingController::class, 'store']);
    Route::get('getAllConsulting', [ConsultingController::class, 'showall']);


    Route::post('pay', [PayController::class, 'pay']);


    Route::post('deleteUser', [AuthController::class, 'deleteUser']);

});
// Route::post('user', [UserController::class, 'store']);

//Route::get('getExperts', [ConsultingController::class, 'getExperts']);

Route::get('searchForExpert', [UserController::class, 'searchForExpert']);
Route::get('searchForCons', [UserController::class, 'searchForCons']);
