<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProxyController;
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

Route::middleware(['api'])->prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::get('/login', 'login')->name('login');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::post('/me', 'me');
    });
});

Route::middleware(['api', 'auth:api'])->prefix('proxies')->group(function () {
    Route::controller(ProxyController::class)->group(function () {
        Route::post('/list', 'list');
        Route::post('/export', 'export');
    });
});

