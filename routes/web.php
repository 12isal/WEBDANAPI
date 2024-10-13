<?php

use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\tamuController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/tamu',[tamuController::class,'index']);
Route::post('/tamuKirim',[tamuController::class,'kirim']);



Route::group(['middleware' => ['auth:web']], function() {
    Route::get('test', function () {
        return view('welcome');
    })->name('test');
    Route::get('logout',[AuthController::class,'logout']);
   
});

// Route::group(['middleware' => 'auth'], function() {
//     // Route::get('/admin', [AdminController::class, 'index']);
//     
    
//    
   
// });
// Route::group(['middleware' => 'auth'], function () {
   
// });
