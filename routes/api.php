<?php

use App\Http\Controllers\AppController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get/{translateTo}/{index}', [AppController::class,'show']);
Route::get('/get-by-id/{translateTo}/{people_id}', [AppController::class,'showById']);
Route::get('/all/{translateTo}', [AppController::class,'index']);
Route::post('/append', [AppController::class,'append']);
