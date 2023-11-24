<?php

use App\Actions\Fortify\ResetUserPassword;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalsUserController;
use App\Http\Controllers\PetShopController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOrSelfUser;
use Illuminate\Support\Facades\Route;

// Route for species
Route::group(['prefix' => 'species'], function () {
    Route::get('/{id}', [SpeciesController::class, 'show'])
        ->name('species.show');
    Route::get('/', [SpeciesController::class, 'index'])
        ->name('species.index');
});

// Route for animal races
Route::group(['prefix' => 'races'], function () {
    Route::get('/{id}', [RaceController::class, 'show'])
        ->name('races.show');
    Route::get('/', [RaceController::class, 'index'])
        ->name('races.index');
});

// Route for pet shops
Route::group(['prefix' => 'pet-shops'], function () {
    Route::get('/{id}', [PetShopController::class, 'show'])
        ->name('pet-shops.show');
    Route::get('/', [PetShopController::class, 'index'])
        ->name('pet-shops.index');
});

// Route for animals
Route::group(['prefix' => 'animals'], function () {
    Route::get('/{id}', [AnimalController::class, 'show'])
        ->name('animals.show');
    Route::get('/', [AnimalController::class, 'index'])
        ->name('animals.index');
});

// Routes for questions
Route::group(['prefix' => "questions"], function () {
    Route::get('/', [QuestionController::class, 'index'])
        ->name('questions.index');
});

// Group for auth routes
Route::middleware(['auth:sanctum', 'account-is-active'])->group(function () {

    // get user logged
    Route::get('/user', [UserController::class, 'showMe']);

    // Update user data
    Route::group(['middleware' => [AdminOrSelfUser::class]], function () {
        // Remove user data
        Route::delete('/user', [UserController::class, 'delete']);
    });

    // Create routes
    Route::post('/species', [SpeciesController::class, 'create'])
        ->name('species.create');
    Route::post('/races', [RaceController::class, 'create'])
        ->name('races.create');
    Route::post('/pet-shops', [PetShopController::class, 'create'])
        ->name('pet-shops.create');
    Route::post('/animals', [AnimalController::class, 'create'])
        ->name('animals.create');
    Route::get('/animals-user', [AnimalsUserController::class, 'index'])
        ->name('animals-user.index');
    Route::post('/animals-user', [AnimalsUserController::class, 'create'])
        ->name('animals-user.create');

    // Route for reset password
    Route::get('/reset-password/', [ResetUserPassword::class, 'reset'])
        ->middleware('guest')
        ->name('password.reset');
});
