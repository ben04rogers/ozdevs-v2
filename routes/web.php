<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DeveloperProfilesController;
use App\Http\Controllers\DevelopersController;
use App\Http\Controllers\GetStartedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricingController;
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

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('/developers', [DevelopersController::class, "index"])->name("developers");
Route::get('/pricing', [PricingController::class, "index"])->name("pricing");

Route::get('/get-started', [GetStartedController::class, "index"])->name("getStarted");

Route::get('/login', [LoginController::class, "index"])->name("login");
Route::post('/login', [LoginController::class, "store"])->middleware('web');
Route::post('/logout', [LoginController::class, "logout"])->name("logout");

Route::get('/register', [RegisterController::class, "index"])->name("register");
Route::post('/register', [RegisterController::class, "store"]);

Route::middleware(['auth'])->group(function () {
    Route::get('/new-developer', [DeveloperProfilesController::class, "index"])->name("newDeveloperForm");
    Route::post('/new-developer', [DeveloperProfilesController::class, "store"])->name("newDeveloper");
});

