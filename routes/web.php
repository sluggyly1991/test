<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\WeatherController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addUser', [ContactsController::class, 'addUser'])->name('contacts.add');

Route::get('/showContacts', [ContactsController::class, 'show'])->name('contacts.show');

Route::get('/showWeather/{id}', [WeatherController::class, 'show'])->name('weather.show.single');