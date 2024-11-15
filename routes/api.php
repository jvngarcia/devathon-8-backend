<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\StatusController;
use App\Http\Middleware\EnsureApiKeyIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware([EnsureApiKeyIsValid::class])->group(
    function () {
        Route::get('/status', [StatusController::class, 'index']);
        Route::post('/addresses', [AddressController::class, 'store']);
        Route::get('/addresses/recent', [AddressController::class, 'show']);
    }
);

Route::get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
)->middleware('auth:sanctum');
