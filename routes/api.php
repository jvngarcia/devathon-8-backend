<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\LaborRegistrationController;
use App\Http\Controllers\LettersController;
use App\Http\Controllers\StatusController;
use App\Http\Middleware\EnsureApiKeyIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware([EnsureApiKeyIsValid::class])->group(
    function () {
        Route::get('/status', [StatusController::class, 'index']);
        Route::post('/addresses', [AddressController::class, 'store']);
        Route::get('/addresses/recent', [AddressController::class, 'show']);

        Route::get('/letters', [LettersController::class, 'index']);
        Route::put('/letter/{id}', [LettersController::class, 'update']);

        Route::post('/labor-registration', [LaborRegistrationController::class, 'create'])->name('labor-registration.create');
        Route::get('/labor-registration/list', [LaborRegistrationController::class, 'index']);
        Route::get('/labor-registration/{id}', [LaborRegistrationController::class, 'show'])->name('labor-registration.show');
        Route::delete('/labor-registration/{id}', [LaborRegistrationController::class, 'destroy']);
    }
);

Route::get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
)->middleware('auth:sanctum');
