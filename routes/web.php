<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\FormController;


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
Route::get('/circles/{circle}/divisions', [MasterController::class, 'getDivisions']);
Route::get('/divisions/{division}/ranges', [MasterController::class, 'getRanges']);
Route::get('/ranges/{range}/sections', [MasterController::class, 'getSections']);
Route::get('/sections/{section}/beats', [MasterController::class, 'getBeats']);
Route::get('/divisions/{division}/forest_blocks', [MasterController::class, 'getForestblocks']);

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/submit-form', [FormController::class, 'submitForm'])->name('submit-form');
