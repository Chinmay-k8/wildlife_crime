<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\UserController;





// Route::get('/', function () {
//     return view('');
// });
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/circles', [MasterController::class, 'getCircles']);
Route::get('/species/{scheduletype}/{schedule}', [MasterController::class, 'getSpeciesBySchedule']);
Route::get('/circles/{circle}/divisions', [MasterController::class, 'getDivisions']);
Route::get('/divisions/{division}/ranges', [MasterController::class, 'getRanges']);
Route::get('/ranges/{range}/sections', [MasterController::class, 'getSections']);
Route::get('/sections/{section}/beats', [MasterController::class, 'getBeats']);
Route::get('/divisions/{division}/forest_blocks', [MasterController::class, 'getForestblocks']);
Route::get('circle-name/{id}', [MasterController::class, 'getCircleNameById']);
Route::get('division-name/{id}', [MasterController::class, 'getDivisionNameById']);
Route::get('range-name/{id}', [MasterController::class, 'getRangeNameById']);
Route::get('section-name/{id}', [MasterController::class, 'getSectionNameById']);
Route::get('beat-name/{id}', [MasterController::class, 'getBeatNameById']);
Route::get('forestblock-name/{id}', [MasterController::class, 'getForestblockNameById']);
Route::get('/list-data', [ListController::class, 'fetchData'])->name('list.data');
Route::get('/users/fetch', [UserController::class, 'fetchData'])->name('users.fetch');

Route::middleware(['auth'])->group(function () {
    Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
    Route::post('/submit-form', [FormController::class, 'submitForm'])->name('submit-form');
    Route::put('/update-form/{id}', [FormController::class, 'updateForm'])->name('update-form');
    Route::get('/excel', [ExcelController::class, 'showForm'])->name('excel.show');
    Route::post('/excel/upload', [ExcelController::class, 'upload'])->name('excel.upload');
    Route::get('/list', [ListController::class, 'showList'])->name('list.show');
    Route::get('/userlist', [UserController::class, 'showUserList'])->name('users.show');
    // Route::get('/list-data', [ListController::class, 'fetchData'])->name('list.data');
    Route::get('/download/{fileType}/{fileName}', [ListController::class, 'downloadDocument'])->name('download.document');
    Route::get('/download_excel', [ExcelController::class, 'download_demo_excel'])->name('download.excel');



});
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('submit-form');
