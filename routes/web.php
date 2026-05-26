<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyDetailsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ViewingController;
use App\Models\PropertyDetails;
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
Route::get('/list-property', function () {
    return view('list-property');
})->name('property.list');
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/dashboard', function () {
    $user = auth()->user();

    // Safety: if roles/guards already handle access, this won't block them.


    // Redirect admins and managers to /admin
    // if ($user && (in_array(strtolower($user->user_type ?? ''), ['admin', 'manager'], true) || $user->hasRole(['Admin','Manager']))) {
    //     return redirect()->route('admin.dashboard');
    // }

    // Redirect Admin
    if ($user && (strtolower($user->user_type ?? '') === 'admin' || $user->hasRole('Admin'))) {
        return redirect()->route('admin.dashboard');
    }

    // Redirect Manager
    if ($user && (strtolower($user->user_type ?? '') === 'manager' || $user->hasRole('Manager'))) {
        return redirect()->route('manager.dashboard');
    }

    // Renters (and anyone else) see the featured listings dashboard

    $featuredProperties = PropertyDetails::take(3)->get();

    return view('dashboard', compact('featuredProperties'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile.index');

    // Client (Renter) Information - read-only, only renter can view their own record
    Route::get('/renter/information', [\App\Http\Controllers\RenterInformationController::class, 'show'])
        ->name('renter.information')
        ->middleware(['auth']);


    Route::get('/staff', [StaffController::class, 'index'])
        ->name('staff.index')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin,Manager');

    // Staff management dashboard (modern UI)
    Route::get('/staff/dashboard', function () {
        return view('staff-dashboard');
    })->name('staff.dashboard')->middleware(['auth']);

    // Admin dashboard
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])
        ->name('admin.dashboard')
        ->middleware(['auth', 'role:Admin']);

    Route::get('/admin/staff', [\App\Http\Controllers\StaffController::class, 'index'])
        ->name('admin.staff')
        ->middleware(['auth', 'role:Admin']);

    Route::get('/admin/reports', [\App\Http\Controllers\AdminController::class, 'reports'])
        ->name('admin.reports')
        ->middleware(['auth', 'role:Admin']);

    Route::get('/branch', [BranchController::class, 'index'])
        ->name('Branch.index');
    Route::resource('branch', BranchController::class);

    // This provides the specific name 'lease.all' requested for your Admin Dashboard
    Route::get('/admin/leases', [LeaseController::class, 'index'])->name('lease.all');

    // Using names() ensures the store route matches the singular 'lease.store' used in your view
    Route::resource('leases', LeaseController::class)->names([
        'create' => 'lease.create',
        'store' => 'lease.store',
        'index' => 'lease.display_all_leases',
    ]);


    //Manager dashboard
    Route::get('/Manager/manager_dashboard', [\App\Http\Controllers\ManagerController::class, 'index'])
        ->name('manager.dashboard')
        ->middleware(['auth', 'role:Manager']);

    // Staff Routes
    Route::get('/staff/create', [StaffController::class, 'create'])
        ->name('staff.create')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');

    Route::post('/staff/store', [StaffController::class, 'store'])
        ->name('staff.store')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');

    Route::get('/staff/{id}', [StaffController::class, 'show'])
        ->name('staff.show');

    Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])
        ->name('staff.edit')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');

    Route::patch('/staff/{id}', [StaffController::class, 'update'])
        ->name('staff.update')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');

    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])
        ->name('staff.destroy')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');

    Route::get('/staff/{id}/next-of-kin', [StaffController::class, 'createNextOfKin'])
        ->name('staff.nextofkin.create')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');

    Route::post('/staff/{id}/next-of-kin', [StaffController::class, 'storeNextOfKin'])
        ->name('staff.nextofkin.store')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin');
    Route::get('/property/create', [PropertyDetailsController::class, 'create'])
        ->name('property.create')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin,Manager,Staff');

    Route::post('/property/details/store', [PropertyDetailsController::class, 'store'])
        ->name('property.details.store')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':Admin,Manager,Staff');

    Route::get('/property/{id}', [PropertyDetailsController::class, 'show'])
        ->name('property.show');

    Route::get('/get-staff/{branch_id}', [PropertyDetailsController::class, 'getStaffByBranch']);

    // Viewing Routes (Client create)
    Route::get('/viewing/create', [ViewingController::class, 'create'])
        ->name('viewing.create');

    Route::post('/viewing/store', [ViewingController::class, 'store'])
        ->name('viewing.store');

    // Admin Viewing Management
    Route::middleware(['auth', 'role:Admin'])->group(function () {
        Route::get('/admin/viewings', [ViewingController::class, 'index'])->name('admin.viewings.index');
        Route::get('/admin/viewings/calendar', [ViewingController::class, 'calendar'])->name('admin.viewings.calendar');
        Route::get('/admin/viewings/{viewing}/edit', [ViewingController::class, 'edit'])->name('viewing.edit');
        Route::put('/admin/viewings/{viewing}', [ViewingController::class, 'update'])->name('viewing.update');
        Route::delete('/admin/viewings/{viewing}', [ViewingController::class, 'destroy'])->name('viewing.destroy');
    });



    // Manager Routes
    Route::get('/Manager/manager_dashboard', [\App\Http\Controllers\ManagerController::class, 'index'])
        ->name('manager.dashboard')
        ->middleware(['auth', 'role:Manager']);
    
    Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager/create-staff', [ManagerController::class, 'create'])
        ->name('manager.create');
    Route::post('/manager/create-staff', [ManagerController::class, 'store'])
        ->name('manager.store');
    });

    // Admin Routes
    Route::middleware(['auth', 'role:Admin'])->group(function () {
        Route::get('/admin/create-staff', [AdminController::class, 'create'])
            ->name('admin.index');
        Route::post('/admin/create-staff', [AdminController::class, 'store'])
            ->name('admin.store');
    });
});


require __DIR__.'/auth.php';
