<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\PhotoController;

Route::get('people', [PeopleController::class, 'index']);
Route::post('people', [PeopleController::class, 'store']);
Route::post('users/{id}/photo', [PhotoController::class, 'upload']);