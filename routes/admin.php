<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminIdeaController;
use App\Http\Controllers\AdminStepsController;

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class,'loginPage'])->name('admin.login');

Route::post('/admin/login', [AdminController::class,'login'])->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])
        ->name('admin.dashboard');

    Route::post('/admin/logout', [AdminController::class,'logout'])
        ->name('admin.logout');

    Route::get('/admin/users', [UserController::class,'index'])
        ->name('admin.users');

    Route::get('/admin/ideas', [AdminIdeaController::class,'index'])
        ->name('admin.ideas');   

    Route::get('/admin/steps', [AdminStepsController::class,'index'])
        ->name('admin.steps');   

});