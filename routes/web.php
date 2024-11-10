<?php

use App\Http\Controllers\SpyController;
use Illuminate\Support\Facades\Route;

Route::post('/spies', [SpyController::class, 'create']);
