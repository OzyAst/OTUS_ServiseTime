<?php

use App\Http\Controllers\Api\RecordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => '/v1',
    'as' => 'api.',
    'middleware' => [
        'auth:api',
    ],
], function () {
    Route::apiResource('record', '\App\Http\Controllers\Api\RecordController')->except(['index']);
    Route::get('/procedure/{procedure_id}/record', [RecordController::class, 'index'])->name('record.index');
});
