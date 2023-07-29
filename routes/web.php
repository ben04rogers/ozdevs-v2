<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyProfilesController;
use App\Http\Controllers\DeveloperProfilesController;
use App\Http\Controllers\DevelopersController;
use App\Http\Controllers\GetStartedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricingController;
use Illuminate\Http\Request;
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

Route::get("/developer-profiles/{id}", [DeveloperProfilesController::class, "show"])->name("developerProfile");

Route::get("/company-profiles/{id}", [CompanyProfilesController::class, "show"])->name("companyProfile");

Route::middleware(['auth'])->group(function () {
    Route::get('/new-developer', [DeveloperProfilesController::class, "index"])->name("newDeveloperForm");
    Route::post('/new-developer', [DeveloperProfilesController::class, "store"])->name("newDeveloper");

    Route::get('/new-company', [CompanyProfilesController::class, "index"])->name("newCompanyForm");
    Route::post('/new-company', [CompanyProfilesController::class, "store"])->name("newCompany");

    Route::get("/developer-profiles/{id}/edit", [DeveloperProfilesController::class, "edit"])->name("editDeveloper");
    Route::put("/developer-profiles/{id}", [DeveloperProfilesController::class, "update"])->name("updateDeveloper");

    Route::get("/company-profiles/{id}/edit", [CompanyProfilesController::class, "edit"])->name("editCompany");
    Route::put("/company-profiles/{id}", [CompanyProfilesController::class, "update"])->name("updateCompany");

    Route::get('/billing-portal', function (Request $request) {
        return $request->user()->redirectToBillingPortal();
    });
});

