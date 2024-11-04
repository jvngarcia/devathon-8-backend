<?php

use App\Http\Controllers\ExampleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function () {
        Route::get('example', [ExampleController::class, 'index']);
    }
);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
