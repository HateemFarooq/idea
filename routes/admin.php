<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminIdeaController;
use App\Http\Controllers\AdminStepsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\CitiesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::post('/admin/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');

    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users');

    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.delete');

    Route::get('/admin/ideas', [AdminIdeaController::class, 'index'])
        ->name('admin.ideas');

    Route::delete('/admin/ideas/{idea}', [AdminIdeaController::class, 'destroy'])
        ->name('admin.ideas.delete');

    Route::get('/admin/ideas/{idea}/steps', [AdminIdeaController::class, 'showSteps'])
        ->name('admin.ideas.steps');

    Route::get('/admin/steps', [AdminStepsController::class, 'index'])
        ->name('admin.steps');

    Route::get('/admin/countries', [CountriesController::class, 'index'])
        ->name('admin.countries');

    Route::get('/admin/countries/create', [CountriesController::class, 'create'])
        ->name('admin.countries.create');

    Route::post('/admin/countries/store', [CountriesController::class, 'store'])
        ->name('admin.countries.store');

    
Route::get('/admin/countries/{country}/edit', [CountriesController::class, 'edit'])
    ->name('admin.countries.edit');

Route::put('/admin/countries/{country}', [CountriesController::class, 'update'])
    ->name('admin.countries.update');

Route::delete('/admin/countries/{country}', [CountriesController::class, 'destroy'])
    ->name('admin.countries.delete');


    // STATES
Route::get('/admin/states', [StatesController::class, 'index'])
        ->name('admin.states');

    Route::get('/admin/states/create', [StatesController::class, 'create'])
        ->name('admin.states.create');

    Route::post('/admin/states/store', [StatesController::class, 'store'])
        ->name('admin.states.store');

    
Route::get('/admin/states/{state}/edit', [StatesController::class, 'edit'])
    ->name('admin.states.edit');

Route::put('/admin/states/{state}', [StatesController::class, 'update'])
    ->name('admin.states.update');

Route::delete('/admin/states/{state}', [StatesController::class, 'destroy'])
    ->name('admin.states.delete');


// CITIES
// CITIES
Route::get('/admin/cities', [CitiesController::class, 'index'])
    ->name('admin.cities');

Route::get('/admin/cities/create', [CitiesController::class, 'create'])
    ->name('admin.cities.create');

Route::post('/admin/cities/store', [CitiesController::class, 'store'])
    ->name('admin.cities.store');

Route::get('/admin/cities/{city}/edit', [CitiesController::class, 'edit'])
    ->name('admin.cities.edit');

Route::put('/admin/cities/{city}', [CitiesController::class, 'update'])
    ->name('admin.cities.update');

Route::delete('/admin/cities/{city}', [CitiesController::class, 'destroy'])
    ->name('admin.cities.delete');

});
