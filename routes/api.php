<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\SwipeController;

Route::get('people', [PeopleController::class, 'index']);
Route::post('people', [PeopleController::class, 'store']);
Route::post('users/{id}/photo', [PhotoController::class, 'upload']);
Route::post('people/{id}/like', [SwipeController::class, 'like']);
Route::post('people/{id}/dislike', [SwipeController::class, 'dislike']);
Route::get('people/liked', [SwipeController::class, 'likedList']);