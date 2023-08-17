<?php

use App\Http\Controllers\conversationsController;
use App\Http\Controllers\MessagesController;
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

//Route::middleware('auth:sanctum')->group(function (){

    Route::get('conversations', [conversationsController::class, 'index']);
    Route::get('conversations/{conversation}', [conversationsController::class, 'show']);
    Route::post('conversations/{conversation}/participants', [conversationsController::class, 'addParticipates']);
    Route::delete('conversations/{conversation}/participants', [conversationsController::class, 'removeParticipates']);

    Route::get('conversations/{id}/messages', [MessagesController::class, 'index']);
    Route::post('messages', [MessagesController::class, 'store']);
    Route::delete('messages/{id}', [MessagesController::class, 'destroy']);
//});
