<?php

use Illuminate\Support\Facades\Route;


// Controller

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\TestSessionController;
use App\Http\Controllers\Admin\CriteriaOptionController;
use App\Http\Controllers\Panelis\AssessmentController;


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
| Admin Area
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {



        /*
        |--------------------------------------------------------------------------
        | Dashboard Admin
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard',

            [AdminDashboardController::class, 'index']

        )
        ->name('dashboard');







        /*
        |--------------------------------------------------------------------------
        | Master Produk
        |--------------------------------------------------------------------------
        */

        Route::resource(

            'products',

            ProductController::class

        );







        /*
        |--------------------------------------------------------------------------
        | Master Sample
        |--------------------------------------------------------------------------
        */

        Route::resource(

            'samples',

            SampleController::class

        );








        /*
        |--------------------------------------------------------------------------
        | Test Session Management
        |--------------------------------------------------------------------------
        */

        Route::resource(

            'test_sessions',

            TestSessionController::class

        );

        Route::post(
    'test_sessions/{testSession}/open',
    [TestSessionController::class,'open']
)
->name('test_sessions.open');



Route::post(
    'test_sessions/{testSession}/finish',
    [TestSessionController::class,'finish']
)
->name('test_sessions.finish');






        /*
        |--------------------------------------------------------------------------
        | Master Skala Penilaian
        |--------------------------------------------------------------------------
        |
        | URL:
        | /admin/criteria_options
        |
        */

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



    });









/*
|--------------------------------------------------------------------------
| Panelis Area
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:panelis'])

->group(function () {



    Route::get('/panelis/dashboard',

        [PanelisDashboardController::class, 'index']

    )

    ->name('panelis.dashboard');


    Route::get(

    '/panelis/assessment/{testSession}',

    [AssessmentController::class,'create']

)
->name('panelis.assessment.create');





Route::post(

    '/panelis/assessment/{testSession}',

    [AssessmentController::class,'store']

)
->name('panelis.assessment.store');


});









/*
|--------------------------------------------------------------------------
| Pimpinan Area
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pimpinan'])

->group(function () {



    Route::get('/pimpinan/dashboard',

        [PimpinanDashboardController::class, 'index']

    )

    ->name('pimpinan.dashboard');



});









/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';