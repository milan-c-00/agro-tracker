<?php

use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\FarmController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\PriceController;
use App\Http\Controllers\api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){

    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::get('/prices', [PriceController::class, 'index']);
Route::get('/prices_widget', [PriceController::class, 'prices_widget']);

Route::get('/post_widget', [PostController::class, 'post_widget']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function (){

    Route::middleware('is_admin')->group(function (){

        Route::post('/prices', [PriceController::class, 'store']);
        Route::put('/prices/{price}', [PriceController::class, 'update']);
        Route::delete('/prices/{price}', [PriceController::class, 'destroy']);

        Route::post('/posts', [PostController::class, 'store']);
        Route::put('/posts/{post}', [PostController::class, 'update']);
        Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    });

    Route::get('/my_farm', [FarmController::class, 'my_farm']);
    Route::get('/my_farm/livestock', [AnimalController::class, 'index']);
    Route::post('/my_farm/livestock', [AnimalController::class, 'store']);
    Route::put('/my_farm/livestock/{animal}', [AnimalController::class, 'update']);
    Route::delete('/my_farm/livestock/{animal}', [AnimalController::class, 'destroy']);

    Route::post('/farms', [FarmController::class, 'store']);


    Route::put('/farms/{farm}', [FarmController::class, 'update']);
    Route::delete('/farms/{farm}', [FarmController::class, 'destroy']);

});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
