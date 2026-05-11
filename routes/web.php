<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// FIXED: Changed name from 'find-home' to 'home.find' to match your Nav Bar
Route::get('/find-a-home', [PropertyController::class, 'index'])->name('home.find');
Route::get('/list-property', function () { return view('list-property'); })->name('property.list');
Route::get('/services', function () { return view('services'); })->name('services');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile.index');

    Route::get('/staff/create', [StaffController::class, 'create'])
        ->name('staff.create');

    Route::post('/staff/store', [StaffController::class, 'store'])
        ->name('staff.store');

    Route::get('/staff/{id}', [StaffController::class, 'show'])
        ->name('staff.show');

    Route::get('/staff/{id}/next-of-kin', [StaffController::class, 'createNextOfKin'])
        ->name('staff.nextofkin.create');

    Route::post('/staff/{id}/next-of-kin', [StaffController::class, 'storeNextOfKin'])
        ->name('staff.nextofkin.store');
});

require __DIR__.'/auth.php';