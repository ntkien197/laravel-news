<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'auth'],function () {
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::group(['middleware' => ['auth.login']],function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/profile',[UserController::class,'profile']);
    Route::post('/change-password',[UserController::class,'changePassword']);

    Route::prefix('post')->group(function () {
       Route::get('', [PostController::class, 'index']) ;
        Route::post('/create',[PostController::class,'create']);
        Route::get('/detail/{id}',[PostController::class,'detail']);
        Route::post('/update/{id}',[PostController::class,'update']);
    });
    Route::group(['prefix'=> 'category'],function () {
       Route::get('',[CategoryController::class,'index']);
       Route::post('/create',[CategoryController::class,'create']);
       Route::get('/detail/{id}',[CategoryController::class,'detail']);
       Route::post('/update/{id}',[CategoryController::class,'update']);
    });
});

