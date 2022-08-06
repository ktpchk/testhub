<?php

use App\Http\Controllers\TestController;
use App\Models\Test;
use Illuminate\Support\Facades\Route;

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

Route::controller(TestController::class)->group(function () {
    Route::get('/', 'welcome');
    Route::get('/tests', 'index');
    Route::get('/tests/create', 'create');
    Route::post('/tests', 'store');
    Route::get('/tests/{test}/publish', 'publish');
    Route::get('/tests/{test}', 'show');
    Route::get('/tests/{test}/question', 'question');
    Route::post('/tests/{test}/question', 'review');
});
