<?php

use Illuminate\Support\Facades\Route;
use App\User\Http\Api\Controllers\UserController;

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

Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'users', 'as' => 'user.'], function() {
        Route::post('/login', [UserController::class, 'login'])->name('login');
        Route::post('/register', [UserController::class, 'register'])->name('register');

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/logout', [UserController::class, 'logout'])->name('logout');
            Route::get('/user', [UserController::class, 'user'])->name('user');
        });
    });
});
