<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketController;
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
Route::get('/theaters/{theater}',[TheaterController::class, 'show'])->name('ShowTheater');
Route::post('/theaters/add',[TheaterController::class, 'store'])->name('AddTheater');
Route::get('/theaters/edit/{theater}',[TheaterController::class, 'edit'])->name('EditTheater');
Route::post('/theaters/update/{theater}',[TheaterController::class, 'update'])->name('UpdateTheater');
// Salon
Route::get('/salons',[SalonController::class, 'index'])->name('salonIndex');
Route::get('/salons/show/{salon}',[SalonController::class, 'show'])->name('ShowSalon');
Route::post('/salons/add',[SalonController::class, 'store'])->name('AddSalon');
Route::get('/salons/edit/{salon}',[SalonController::class, 'edit'])->name('EditSalon');
Route::post('/salons/update/{salon}',[SalonController::class, 'update'])->name('UpdateSalon');

//Classe
Route::post('/salons/addclass',[ClassController::class, 'store'])->name('AddClassToSalon');
Route::post('/salons/classes/update/{classe}',[ClassController::class, 'update'])->name('UpdateClass');
Route::get('/salons/classes/{classe}',[ClassController::class, 'show'])->name('ShowClass');

//Seat
Route::post('/salons/classes/addseat',[SeatController::class, 'store'])->name('AddSeatToClass');

//Price
Route::post('/theaters/price/add',[PriceController::class, 'store'])->name('AddPriceToTheater');

//Show
Route::post('/shows/add',[ShowController::class, 'store'])->name('AddShowToTheater');
Route::get('/shows',[ShowController::class, 'index'])->name('ShowIndex');
Route::get('/shows/{show}',[ShowController::class, 'show'])->name('ShowShow');

//Booking
Route::post('/Booking/add',[BookingController::class, 'store'])->name('AddBooking');
Route::get('/Bookings',[BookingController::class, 'index'])->name('BookingIndex');
Route::get('/Bookings/{booking}',[BookingController::class, 'show'])->name('ShowBooking');

//Ticket
Route::get('/Tickets/{booking}',[TicketController::class, 'show'])->name('ShowTickets');
