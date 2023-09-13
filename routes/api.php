<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ChatController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify-code');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/get-all-user', [UserController::class, 'getAllUser'])->name('get-all-user');

    Route::post('/chat', [ChatController::class, 'message'])->name('chat');
    Route::get('/get-all-conversation', [ChatController::class, 'getAllConversation'])->name('get-all-conversation');
});
