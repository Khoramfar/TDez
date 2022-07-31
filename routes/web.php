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
use App\Http\Controllers\MainController;

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

Route::get('/',[MainController::class, 'index'])->name('home');

// Mainpages
Route::get('/faq', function () {
    return view('faq');
})->name('faq'); // Soalate motedavel

Route::get('/rules', function () {
    return view('rules');
})->name('rules'); // Ghavanin

Route::get('/about', function () {
    return view('about');
})->name('about'); // darbare ma

Route::get('/contact', function () {
    return view('contact');
})->name('contact'); // tamas ba ma


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Theater

Route::get('/theaters',[TheaterController::class, 'index'])->name('theaterIndex');
Route::get('/theaters/{theater}',[TheaterController::class, 'manage'])->name('ShowTheater');
Route::post('/theaters/add',[TheaterController::class, 'store'])->name('AddTheater');
Route::post('/theaters/update/{theater}',[TheaterController::class, 'update'])->name('UpdateTheater');
Route::post('/theaters/ispublic/{theater}',[TheaterController::class, 'is_public'])->name('PublicTheater');

Route::get('/theaters/buy/{theater}',[TheaterController::class, 'show'])->name('TheaterBuy');

// Salon
Route::get('/salons',[SalonController::class, 'index'])->name('salonIndex');
Route::get('/salons/show/{salon}',[SalonController::class, 'show'])->name('ShowSalon');
Route::post('/salons/add',[SalonController::class, 'store'])->name('AddSalon');
Route::get('/salons/edit/{salon}',[SalonController::class, 'edit'])->name('EditSalon');
Route::post('/salons/update/{salon}',[SalonController::class, 'update'])->name('UpdateSalon');

//Classe
Route::post('/salons/addclass',[ClassController::class, 'store'])->name('AddClassToSalon');
Route::post('/salons/classes/update/{classe}',[ClassController::class, 'update'])->name('UpdateClass');
Route::get('/salons/{salon}/classes',[ClassController::class, 'index'])->name('ClassIndex');
Route::get('/salons/classes/{classe}',[ClassController::class, 'show'])->name('ShowClass');

//Seat
Route::post('/salons/classes/addseat',[SeatController::class, 'store'])->name('AddSeatToClass');

//Price
Route::post('/theaters/price/add',[PriceController::class, 'store'])->name('AddPriceToTheater');
Route::get('/theaters/{theater}/price',[PriceController::class, 'index'])->name('PriceIndex');
Route::get('/theaters/price/{price}',[PriceController::class, 'show'])->name('ShowPrice');
Route::post('/theaters/price/update/{price}',[PriceController::class, 'update'])->name('UpdatePrice');

//Show
Route::get('/theaters/{theater}/shows',[ShowController::class, 'showmanage'])->name('ShowManage');
Route::post('/shows/ispublic/{show}',[ShowController::class, 'is_public'])->name('PublicShow');
Route::post('/shows/add',[ShowController::class, 'store'])->name('AddShowToTheater');
Route::get('/shows',[ShowController::class, 'index'])->name('ShowIndex');
Route::get('/shows/{show}',[ShowController::class, 'show'])->name('ShowShow');
Route::get('/shows/{show}/stats',[ShowController::class, 'stats'])->name('ShowStats');

//Booking
Route::post('/Booking/add',[BookingController::class, 'store'])->name('AddBooking');
Route::get('/Bookings',[BookingController::class, 'index'])->name('BookingIndex');
Route::get('/Bookings/{booking}',[BookingController::class, 'show'])->name('ShowBooking');

//Ticket
Route::get('/Tickets/{booking}',[TicketController::class, 'show'])->name('ShowTickets');

