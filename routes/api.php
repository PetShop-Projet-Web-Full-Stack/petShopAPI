<?php
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\PetShopController;
use App\Http\Controllers\SpeciesController;

Route::group(['prefix' => 'species'], function () {
    Route::get('/{id}', [SpeciesController::class, 'show']);
    Route::get('/', [SpeciesController::class, 'index']);
    Route::post('/', [SpeciesController::class, 'create']);
});

Route::group(['prefix' => 'races'], function () {
    Route::get('/{id}', [RaceController::class, 'show']);
    Route::get('/', [RaceController::class, 'index']);
    Route::post('/', [RaceController::class, 'create']);
});

Route::group(['prefix' => 'pet-shops'], function () {
    Route::get('/{id}', [PetShopController::class, 'show']);
    Route::get('/', [PetShopController::class, 'index']);
    Route::post('/', [PetShopController::class, 'create']);
});

// Route for reset password
Route::get('/reset-password/', [ResetUserPassword::class,'reset'])
    ->middleware(['guest'])
    ->name('password.reset');

// Group for auth routes
Route::middleware('auth:sanctum')->group(function () {

    // TODO : Add your routes auth here

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
}
  
Route::group(['prefix' => 'animals'], function () {
    Route::get('/{id}', [AnimalController::class, 'show']);
    Route::get('/', [AnimalController::class, 'index']);
    Route::post('/', [AnimalController::class, 'create']);

});
