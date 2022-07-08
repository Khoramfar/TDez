<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\SalonController;

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
require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Theater
Route::get('/theaters',[TheaterController::class, 'index'])->name('theaterIndex');
Route::get('/books/show/{theater}',[TheaterController::class, 'show'])->name('ShowTheater');
Route::post('/theaters/add',[TheaterController::class, 'store'])->name('AddTheater');
Route::get('/theaters/edit/{theater}',[TheaterController::class, 'edit'])->name('EditTheater');
Route::post('/theaters/update/{theater}',[TheaterController::class, 'update'])->name('UpdateTheater');
// Salon
Route::get('/salons',[SalonController::class, 'index'])->name('salonIndex');
Route::get('/salons/show/{salon}',[SalonController::class, 'show'])->name('ShowSalon');
Route::post('/salons/add',[SalonController::class, 'store'])->name('AddSalon');
Route::get('/salons/edit/{salon}',[SalonController::class, 'edit'])->name('EditSalon');
Route::post('/salons/update/{salon}',[SalonController::class, 'update'])->name('UpdateSalon');
