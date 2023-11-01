<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Actions\Fortify\ResetUserPassword;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalsUserController;
use App\Http\Controllers\PetShopController;
use App\Http\Controllers\SpeciesController;

// Route for species
Route::group(['prefix' => 'species'], function () {
    Route::get('/{id}', [SpeciesController::class, 'show']);
    Route::get('/', [SpeciesController::class, 'index']);
});

// Route for animal races
Route::group(['prefix' => 'races'], function () {
    Route::get('/{id}', [RaceController::class, 'show']);
    Route::get('/', [RaceController::class, 'index']);
});

// Route for pet shops
Route::group(['prefix' => 'pet-shops'], function () {
    Route::get('/{id}', [PetShopController::class, 'show']);
    Route::get('/', [PetShopController::class, 'index']);
});

// Route for animals
Route::group(['prefix' => 'animals'], function () {
    Route::get('/{id}', [AnimalController::class, 'show']);
    Route::get('/', [AnimalController::class, 'index']);
});

// Route for favorites animals
Route::group(['prefix' => 'animals-user'], function () {
    Route::get('/', [AnimalsUserController::class, 'index']);
});

// Group for auth routes
Route::middleware('auth:sanctum')->group(function () {
    // Route for user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Create routes
    Route::post('/species', [SpeciesController::class, 'create']);
    Route::post('/races', [RaceController::class, 'create']);
    Route::post('/pet-shops', [PetShopController::class, 'create']);
    Route::post('/animals', [AnimalController::class, 'create']);
    Route::post('/animals-user', [AnimalsUserController::class, 'create']);

    // Route for reset password
    Route::get('/reset-password/', [ResetUserPassword::class, 'reset'])
        ->middleware(['guest'])
        ->name('password.reset');
});
