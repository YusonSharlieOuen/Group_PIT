<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\PropertyDetailsController;
use App\Http\Controllers\ViewingController;
use App\Http\Controllers\BranchController;
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
Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
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

    Route::get('/staff', [StaffController::class, 'index'])
        ->name('staff.index');

    Route::get('/branch', [BranchController::class, 'index'])
        ->name('Branch.index');
    Route::resource('branch', BranchController::class);

    Route::get('/create_lease', [LeaseController::class, 'index'])->name('Lease.index');

    // Staff Routes
    Route::get('/staff/create', [StaffController::class, 'create'])
        ->name('staff.create');

    Route::post('/staff/store', [StaffController::class, 'store'])
        ->name('staff.store');

    Route::get('/staff/{id}', [StaffController::class, 'show'])
        ->name('staff.show');

    Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])
        ->name('staff.edit');

    Route::patch('/staff/{id}', [StaffController::class, 'update'])
        ->name('staff.update');

    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])
        ->name('staff.destroy');

    Route::get('/staff/{id}/next-of-kin', [StaffController::class, 'createNextOfKin'])
        ->name('staff.nextofkin.create');

    Route::post('/staff/{id}/next-of-kin', [StaffController::class, 'storeNextOfKin'])
        ->name('staff.nextofkin.store');

    // Lease Routes
    Route::get('/leases', [LeaseController::class, 'display_all_leases'])
        ->name('lease.all');

    Route::get('/lease/create', [LeaseController::class, 'create'])
        ->name('lease.create');

    Route::post('/lease/store', [LeaseController::class, 'store'])
        ->name('lease.store');

    // Property Details Routes
    Route::get('/property', [PropertyDetailsController::class, 'index'])
        ->name('property.index');

    Route::get('/property/create', [PropertyDetailsController::class, 'create'])
        ->name('property.create');

    Route::get('/property/{id}', [PropertyDetailsController::class, 'show'])
        ->name('property.show');

    Route::get('/get-staff/{branch_id}', [PropertyDetailsController::class, 'getStaffByBranch']);

    // Viewing Routes
    Route::get('/viewing/create', [ViewingController::class, 'create'])
        ->name('viewing.create');

    Route::post('/viewing/store', [ViewingController::class, 'store'])
        ->name('viewing.store');

    // Manager Routes
    Route::get('/manager/create-staff', [ManagerController::class, 'create'])
        ->name('manager.create');
    Route::post('/manager/create-staff', [ManagerController::class, 'store'])
        ->name('manager.store');

    // Admin Routes
    Route::get('/admin/create-staff', [AdminController::class, 'create'])
        ->name('admin.index');
    Route::post('/admin/create-staff', [AdminController::class, 'store'])
        ->name('admin.store');
});

require __DIR__.'/auth.php';
