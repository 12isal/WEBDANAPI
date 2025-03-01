<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\tamuController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('refresh',[AuthController::class,'refresh'] );
    Route::post('me',[AuthController::class,'me'] );

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('pesan', [tamuController::class, 'pesamTamu']);
        Route::get('index', [tamuController::class, 'storeTamu']);
    });




   

});
