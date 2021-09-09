<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('account', [ClientController::class, 'all']);
Route::post('register', [ClientController::class, 'store']);
