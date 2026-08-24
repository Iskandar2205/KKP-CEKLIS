<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Panelis\DashboardController as PanelisDashboardController;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;


/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('login');

});


/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
->group(function () {

    Route::get('/admin/dashboard', 
        [AdminDashboardController::class, 'index']
    )
    ->name('admin.dashboard');

});



/*
|--------------------------------------------------------------------------
| Dashboard Panelis
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:panelis'])
->group(function () {

    Route::get('/panelis/dashboard',
        [PanelisDashboardController::class, 'index']
    )
    ->name('panelis.dashboard');

});



/*
|--------------------------------------------------------------------------
| Dashboard Pimpinan
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pimpinan'])
->group(function () {

    Route::get('/pimpinan/dashboard',
        [PimpinanDashboardController::class, 'index']
    )
    ->name('pimpinan.dashboard');

});



require __DIR__.'/auth.php';