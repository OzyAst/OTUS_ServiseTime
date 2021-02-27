<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\RecordController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProcedureTimeController;

/**
 * Все клиентские страницы
 */
Route::group([
    'middleware' => [
        'all',
    ],
], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/localize/{locale}', [\App\Http\Controllers\LocalizeController::class, 'setLocale'])
        ->name('localize.set');

    Route::get('/business/{business}', [\App\Http\Controllers\BusinessController::class, 'show'])
        ->name('business.show');

    /**
     * Страницы закрытые
     */
    Route::group([
        'middleware' => [
            'auth',
        ],
    ], function () {
        Route::get('/home', [HomeController::class, 'home'])->name('home');
        Route::get('/home/business', [HomeController::class, 'business'])->name('home.business');
        Route::get('/business/create', [\App\Http\Controllers\BusinessController::class, 'create'])
            ->name('business.create');
        Route::post('/business/store', [\App\Http\Controllers\BusinessController::class, 'store'])
            ->name('business.store');


        Route::group([
            'middleware' => [
                'can:accessBusinessPanel',
            ],
        ], function () {
            Route::resources(['procedure' => '\App\Http\Controllers\ProcedureController']);
            Route::resources(['record' => '\App\Http\Controllers\RecordController']);
            Route::resources(['feedback' => '\App\Http\Controllers\FeedbackController']);
            Route::resources(['address' => '\App\Http\Controllers\BusinessAddressController']);

            Route::post('/record/changeStatus/{record}', [RecordController::class, 'changeStatus'])->name('record.changeStatus');
            Route::post('/record/cancel/{record}', [RecordController::class, 'cancel'])->name('record.cancel');

            Route::resource('time', '\App\Http\Controllers\ProcedureTimeController')->only(['store']);
            Route::get('/time/create/{procedure}', [ProcedureTimeController::class, 'create'])
                ->name('time.create');
            Route::get('/time/edit/{procedure}', [ProcedureTimeController::class, 'edit'])
                ->name('time.edit');
            Route::patch('/time/{procedure}', [ProcedureTimeController::class, 'update'])
                ->name('time.update');

            Route::resource('contact','\App\Http\Controllers\BusinessContactController')->except(['create']);
            Route::get('/contact/create/{address}', [BusinessContactController::class, 'create'])
            ->name('contact.create');

            Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic.index');
            Route::get('/statistic/salary', [StatisticController::class, 'salary'])->name('statistic.salary');
            Route::get('/statistic/records', [StatisticController::class, 'records'])->name('statistic.records');
            Route::get('/statistic/clients', [StatisticController::class, 'clients'])->name('statistic.clients');

            Route::get('/staff', [\App\Http\Controllers\StaffController::class, 'index']);
            Route::get('/message', [\App\Http\Controllers\MessageController::class, 'index']);

            Route::get('/business', [\App\Http\Controllers\BusinessController::class, 'index'])
                ->name('business.index');
            Route::get('/business/edit/{business}', [\App\Http\Controllers\BusinessController::class, 'edit'])
                ->name('business.edit')
                ->middleware("can:accessMyBusinessPanel,business");
            Route::patch('/business/{business}', [\App\Http\Controllers\BusinessController::class, 'update'])
                ->name('business.update')
                ->middleware("can:accessMyBusinessPanel,business");
            Route::delete('/business/{business}', [\App\Http\Controllers\BusinessController::class, 'destroy'])
                ->name('business.destroy')
                ->middleware("can:accessMyBusinessPanel,business");
        });
    });
});

/**
 * Админка
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        'can:accessAdminPanel',
    ],
], function () {
    Route::resources([
        'business' => 'Admin\BusinessController',
        'procedure' => 'Admin\ProcedureController',
    ]);
});

Auth::routes();
