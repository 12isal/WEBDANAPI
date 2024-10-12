<?php

use App\Http\Controllers\web\AuthController;
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


Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'login']);



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
