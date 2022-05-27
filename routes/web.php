<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, function () {
    return view('home');
}]);

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/custom-logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
    Route::resource('companies', App\Http\Controllers\CompanyController::class);
    Route::get('/company/{company}/events', [App\Http\Controllers\CompanyController::class, 'events'])->name('companies.events');
    Route::resource('events', App\Http\Controllers\CompanyEventController::class);
    Route::post('/upload/pdf', [App\Http\Controllers\EventsPdfController::class, 'uploadPdf'])->name('upload.pdf');
    Route::post('/{event}/upload/pdf', [App\Http\Controllers\EventsPdfController::class, 'eventUploadPdf'])->name('event.upload.pdf');
    Route::delete('/events/{pdf}/delete', [App\Http\Controllers\EventsPdfController::class, 'destroy'])->name('eventPdf.destroy');
    Route::get('/events/{companyEvent}/pdfs', [App\Http\Controllers\CompanyEventController::class, 'show'])->name('events.pdfs');
});


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('storage:link');
    return "Cache is cleared";
});


// for public users
Route::get('/{company}/{companyEvent}', [App\Http\Controllers\HomeController::class, 'showCompanyEvent'])->name('company.event');
