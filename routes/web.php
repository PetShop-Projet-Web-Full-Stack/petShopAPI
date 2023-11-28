<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route for admin
Route::group(['prefix' => 'admin'], function () {

    // Get login page for admin
    Route::get('/login', [UserController::class, 'login'])
        ->name('admin.login');

    // Post login page for admin
    Route::post('/login', [UserController::class, 'loginPost'])
        ->name('admin.loginPost');

    // Logout
    Route::get('/logout', [UserController::class, 'logout'])
        ->name('admin.logout');

    Route::group(['middleware' => 'authAdmin'], function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.index');

        // Get by id
        Route::get('/edit-animal/{id}', [AdminController::class, 'editAnimal'])
            ->name('admin.editAnimal');
        Route::get('/edit-petshop/{id}', [AdminController::class, 'editPetShop'])
            ->name('admin.editPetShop');

        // Update
        Route::put('/update-animal/{id}', [AdminController::class, 'updateAnimal'])
            ->name('admin.updateAnimal');
        Route::put('/update-petshop/{id}', [AdminController::class, 'updatePetShop'])
            ->name('admin.updatePetShop');

        // Delete
        Route::get('/delete-animal/{id}', [AdminController::class, 'deleteAnimal'])
            ->name('admin.deleteAnimal');
        Route::get('/delete-petshop/{id}', [AdminController::class, 'deletePetShop'])
            ->name('admin.deletePetShop');
    });

});
