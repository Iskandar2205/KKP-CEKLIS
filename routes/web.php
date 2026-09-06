<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
*/


use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\TestSessionController as AdminTestSessionController;
use App\Http\Controllers\Admin\CriteriaOptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TemplateController;


use App\Http\Controllers\Panelis\DashboardController as PanelisDashboardController;
use App\Http\Controllers\Panelis\AssessmentController;


use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use App\Http\Controllers\Pimpinan\TestSessionController as PimpinanTestSessionController;
use App\Http\Controllers\Pimpinan\MonitoringController;



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
| ADMIN AREA
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','role:admin'])

->prefix('admin')

->name('admin.')

->group(function(){



    Route::get(
        '/dashboard',
        [AdminDashboardController::class,'index']
    )
    ->name('dashboard');




    Route::resource(
        'users',
        UserController::class
    );



    Route::resource(
        'products',
        ProductController::class
    );



    Route::get(
        'products/{product}/dataset',
        [ProductController::class,'dataset']
    )
    ->name('products.dataset');



    Route::post(
        'products/{product}/dataset',
        [ProductController::class,'importDataset']
    )
    ->name('products.dataset.import');



    Route::resource(
        'samples',
        SampleController::class
    );




    Route::resource(
        'test_sessions',
        AdminTestSessionController::class
    );



    Route::post(
        'test_sessions/{testSession}/open',
        [AdminTestSessionController::class,'open']
    )
    ->name('test_sessions.open');



    Route::post(
        'test_sessions/{testSession}/finish',
        [AdminTestSessionController::class,'finish']
    )
    ->name('test_sessions.finish');



    Route::get(
        'test_sessions/{testSession}/results',
        [AdminTestSessionController::class,'results']
    )
    ->name('test_sessions.results');



    Route::get(
        'test_sessions/{testSession}/export-excel',
        [AdminTestSessionController::class,'exportExcel']
    )
    ->name('test_sessions.exportExcel');



    Route::get(
        'test_sessions/{testSession}/export-pdf',
        [AdminTestSessionController::class,'exportPdf']
    )
    ->name('test_sessions.exportPdf');



    Route::resource(
        'criteria_options',
        CriteriaOptionController::class
    )
    ->only([
        'index',
        'create',
        'store',
        'destroy'
    ]);



    Route::get(
        'templates',
        [TemplateController::class,'index']
    )
    ->name('templates.index');



    Route::post(
        'templates/import',
        [TemplateController::class,'import']
    )
    ->name('templates.import');



    Route::get(
        'templates/download',
        [TemplateController::class,'download']
    )
    ->name('templates.download');


});







/*
|--------------------------------------------------------------------------
| PANELIS AREA
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','role:panelis'])

->prefix('panelis')

->name('panelis.')

->group(function(){



    Route::get(
        '/dashboard',
        [PanelisDashboardController::class,'index']
    )
    ->name('dashboard');



    Route::get(
        '/assessment/{testSession}',
        [AssessmentController::class,'create']
    )
    ->name('assessment.create');



    Route::post(
        '/assessment/{testSession}',
        [AssessmentController::class,'store']
    )
    ->name('assessment.store');


});








/*
|--------------------------------------------------------------------------
| PIMPINAN AREA
|--------------------------------------------------------------------------
*/


Route::middleware(['auth','role:pimpinan'])

->prefix('pimpinan')

->name('pimpinan.')

->group(function(){



    Route::get(
        '/dashboard',
        [PimpinanDashboardController::class,'index']
    )
    ->name('dashboard');




    Route::get(
        '/test_sessions/{testSession}',
        [PimpinanTestSessionController::class,'show']
    )
    ->name('test_sessions.show');




    Route::get(
        '/test_sessions/{testSession}/pdf',
        [PimpinanTestSessionController::class,'pdf']
    )
    ->name('test_sessions.pdf');




    Route::get(
        '/test_sessions/{testSession}/excel',
        [PimpinanTestSessionController::class,'excel']
    )
    ->name('test_sessions.excel');

    Route::get(

    '/monitoring',

    [MonitoringController::class,'index']

    )

    ->name('monitoring.index');


});







/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/


require __DIR__.'/auth.php';