<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LeadController::class, 'show']);
Route::post('/', [LeadController::class, 'store']);
