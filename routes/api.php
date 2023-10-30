<?php

use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

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

});
