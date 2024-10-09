<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\imamsController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\masajidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\chairmenController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\husbandsController;
use App\Http\Controllers\marriagesController;
use App\Http\Controllers\muazzinsController;
use App\Http\Controllers\profilesController;
use App\Http\Controllers\wivesController;

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

Route::middleware(['auth', 'verified'])->controller(dashboardController::class)->group(function() {
    Route::get('/dashboard', 'show')->name('dashboard');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

    Route::middleware(['auth'])->controller(usersController::class)->group(function () {
        // Show user Data in Database
        Route::get('/users_database', 'show')->middleware('can:isAdmin');
        // App Add User
        Route::get('/UsersRegister', 'create')->name('UsersRegister');
        // App Store User
        Route::post('/UsersRegister', 'store')->name('usersRegister.store');
        // Edit user Data
        Route::get('/users_database/{id}/edit_user', 'edit')->middleware('can:isAdmin');
        // Update user
        Route::put('/users_database/{id}', 'update')->middleware('can:isAdmin');
        // Delete user
        Route::delete('users_database/{id}', 'delete')->middleware('can:isAdmin');
        });

    //CRUD for Masajid
    // Route::controller(masajidController::class)->group(function () {
        // Show Masajid Registration Form
        // Route::get('/masajid_reg_form', 'create')->middleware('can:isAdmin');
        // Store Masajid Data in Database
        // Route::post('/masajid_reg_form', 'store')->middleware('can:isAdmin');
        // Show Masjid Data in Database
        // Route::get('/masajid_database', 'show');
        // View Single Masjid Data
        // Route::get('/masajid_database/{id}', 'view');
        // Edit Masjid Data
        // Route::get('/masajid_database/{id}/edit_masjid', 'edit')->middleware('can:isAdmin');
        // Update Masjid
        // Route::put('/masajid_database/{id}', 'update')->middleware('can:isAdmin');
        // Delete Masjid
        // Route::delete('masajid_database/{id}', 'delete')->middleware('can:isAdmin');
        // });

    //CRUD for Chairmen
    Route::middleware(['auth'])->controller(masajidController::class)->group(function () {
        // Show Masjid Registration Form
        Route::get('/masajid_reg_form', 'create')->middleware('can:isAdmin');
        // Store Masjid Data in Database
        Route::post('/masajid_reg_form', 'store')->middleware('can:isAdmin');
        // Show Masjid Data in Database
        Route::get('/masajid_database', 'show');
        // View Single Masjid Data
        Route::get('/masajid_database/{id}', 'view');
        // Edit Masjid Data
        Route::get('/masajid_database/{id}/edit_masjid', 'edit')->middleware('can:isAdmin');
        // Update Masjid
        Route::put('/masajid_database/{id}', 'update')->middleware('can:isAdmin');
        // Delete Masjid
        Route::delete('masajid_database/{id}', 'delete')->middleware('can:isAdmin');

        // Show Masajid of The Profile
        Route::get('profileMasajidDatabase/{id}', 'profileMasajid');
        });

    //CRUD for Chairmen
    // Route::controller(chairmenController::class)->group(function () {
    //     // Show Chairmen Registration Form
    //     Route::get('/chairmen_reg_form', 'create')->middleware('can:isAdmin');
    //     // Store Chairmen Data in Database
    //     Route::post('/chairmen_reg_form', 'store')->middleware('can:isAdmin');
    //     // Show Chairman Data in Database
    //     Route::get('/chairmen_database', 'show')->middleware('can:isAdmin');
    //     // View Single Chairman Data
    //     Route::get('/chairmen_database/{id}', 'view')->middleware('can:isMasjid');
    //     // Edit Chairman Data
    //     Route::get('/chairmen_database/{id}/edit_chairman', 'edit')->middleware('can:isAdmin');
    //     // Update Chairman
    //     Route::put('/chairmen_database/{id}', 'update')->middleware('can:isAdmin');
    //     // Delete Chairman
    //     Route::delete('chairmen_database/{id}', 'delete')->middleware('can:isAdmin');
    //     });

    //CRUD for Imams
    // Route::controller(imamsController::class)->group(function () {
    //     // Show Imams Registration Form
    //     Route::get('/imams_reg_form', 'create')->middleware('can:isAdmin');
    //     // Store Imams Data in Database
    //     Route::post('/imams_reg_form', 'store')->middleware('can:isAdmin');
    //     // Show Imam Data in Database
    //     Route::get('/imams_database', 'show')->middleware('can:isAdmin');
    //     // View Single Imam Data
    //     Route::get('/imams_database/{id}', 'view')->middleware('can:isMasjid');
    //     // Edit Imam Data
    //     Route::get('/imams_database/{id}/edit_imam', 'edit')->middleware('can:isAdmin');
    //     // Update Imam
    //     Route::put('/imams_database/{id}', 'update')->middleware('can:isAdmin');
    //     // Delete Imam
    //     Route::delete('imams_database/{id}', 'delete')->middleware('can:isAdmin');
    //     });

    //CRUD for Masajid
    // Route::controller(muazzinsController::class)->group(function () {
    //     // Show Muazzins Registration Form
    //     Route::get('/muazzins_reg_form', 'create')->middleware('can:isAdmin');
    //     // Store Muazzins Data in Database
    //     Route::post('/muazzins_reg_form', 'store')->middleware('can:isAdmin');
    //     // Show Muazzin Data in Database
    //     Route::get('/muazzins_database', 'show')->middleware('can:isAdmin');
    //     // View Single Muazzin Data
    //     Route::get('/muazzins_database/{id}', 'view')->middleware('can:isMasjid');
    //     // Edit Muazzin Data
    //     Route::get('/muazzins_database/{id}/edit_muazzin', 'edit')->middleware('can:isAdmin');
    //     // Update Muazzin
    //     Route::put('/muazzins_database/{id}', 'update')->middleware('can:isAdmin');
    //     // Delete Muazzin
    //     Route::delete('muazzins_database/{id}', 'delete')->middleware('can:isAdmin');
    //     });

    //CRUD for Husbands
    Route::middleware(['auth'])->controller(profilesController::class)->group(function () {
        // Show Profiles Registration Form
        Route::get('/profiles_reg_form', 'create');
        // Store profiles Data in Database
        Route::post('/profiles_reg_form', 'store');
        // Show profile Data in Database
        Route::get('/profiles_database', 'show')->middleware('can:isAdmin');
        // View Single profile Data
        Route::get('/profiles_database/{id}', 'view');
        // Edit profile Data
        Route::get('/profiles_database/{id}/edit_profile', 'edit');
        // Update profile
        Route::put('/profiles_database/{id}', 'update');
        // Delete profile
        Route::delete('profiles_database/{id}', 'delete')->middleware('can:isAdmin');
        });

    //CRUD for Wives
    // Route::controller(wivesController::class)->group(function () {
    //     // Show Wives Registration Form
    //     Route::get('/wives_reg_form', 'create')->middleware('can:isWife');
    //     // Store Wifes Data in Database
    //     Route::post('/wives_reg_form', 'store')->middleware('can:isWife');
    //     // Show Wife Data in Database
    //     Route::get('/wives_database', 'show')->middleware('can:isAdmin');
    //     // View Single Wife Data
    //     Route::get('/wives_database/{id}', 'view')->middleware('can:isWife');
    //     // Edit Wife Data
    //     Route::get('/wives_database/{id}/edit_wife', 'edit')->middleware('can:isWife');
    //     // Update Wife
    //     Route::put('/wives_database/{id}', 'update')->middleware('can:isWife');
    //     // Delete Wife
    //     Route::delete('wives_database/{id}', 'delete')->middleware('can:isAdmin');
    //     });
    //CRUD for Marriages
    Route::middleware(['auth'])->controller(marriagesController::class)->group(function () {
        // Show Marriages Registration Form
        Route::get('/marriages_reg_form', 'create');
        // Store Marriages Data in Database
        Route::post('/marriages_reg_form', 'store');
        // Show Marriage Data in Database
        Route::get('/marriages_database', 'show');
        // View Single Marriage Data
        Route::get('/marriages_database/{id}', 'view')->name('viewMarriage');
        // Edit Marriage Data
        Route::get('/marriages_database/{id}/edit_marriage', 'edit');
        // Update Marriage
        Route::put('/marriages_database/{id}', 'update');
        // Delete Marriage
        Route::delete('marriages_database/{id}', 'delete')->middleware('can:isAdmin');

        // Show Marriage for Single Profile
        Route::get('profileMarriages/{id}', 'showMarriageForProfile');
        // Show Marriage for Wakil
        Route::get('wakilMarriages/{id}', 'showMarriageForWakil');
        // Show Marriage for Waliyy
        Route::get('waliyyMarriages/{id}', 'showMarriageForWaliyy');

        // Approve Marriage
        Route::post('/marriages/approve/{marriageId}', 'approveMarriage')->name('approveMarriage');
        // Activate Marriage
        Route::post('/marriages/{marriageId}/activate', 'activateMarriage')->name('marriages.activate');
        // De-Activate Marriage
        Route::post('/marriages/{marriageId}/deactivate', 'deactivateMarriage')->name('marriages.deactivate');
        });