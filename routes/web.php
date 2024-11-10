<?php

use App\Http\Controllers\SpyController;
use Illuminate\Support\Facades\Route;

Route::post('/spies', [SpyController::class, 'create']);
Route::post('/spies/random', [SpyController::class, 'random']);
Route::post('/spies/list', [SpyController::class, 'list']);
