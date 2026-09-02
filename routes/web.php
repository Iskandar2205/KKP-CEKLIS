<?php

use Illuminate\Support\Facades\Route;


// Controller

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\TestSessionController;
use App\Http\Controllers\Admin\CriteriaOptionController;
use App\Http\Controllers\Panelis\AssessmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TemplateController;



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




        Route::resource(
    'users',
    UserController::class
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



    /*
|--------------------------------------------------------------------------
| Template Penilaian Excel
|--------------------------------------------------------------------------
*/


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
| Panelis Area
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:panelis'])
    ->prefix('panelis')
    ->name('panelis.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Dashboard Panelis
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard',

            [PanelisDashboardController::class, 'index']

        )
        ->name('dashboard');





        /*
        |--------------------------------------------------------------------------
        | Penilaian Organoleptik
        |--------------------------------------------------------------------------
        */


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