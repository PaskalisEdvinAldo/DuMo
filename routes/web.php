<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResidenceController;
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

Route::get('/', function () {
    return view('welcome');
});

//Home
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Citizen
Route::get('/citizen', [CitizenController::class, 'index'])->name('citizen.index');
Route::post('/citizen', [CitizenController::class, 'store'])->name('citizen.store');
Route::get('/citizen/show', [CitizenController::class, 'show'])->name('citizen.show');
Route::get('/citizen/edit/{id}', [CitizenController::class, 'edit'])->name('citizen.edit');
Route::put('/citizen/{citizen}', [CitizenController::class, 'update'])->name('citizen.update');
Route::delete('/citizen/{id}', [CitizenController::class, 'destroy'])->name('citizen.destroy');

//Residence
Route::get('/residence', [ResidenceController::class, 'index'])->name('residence.index');
Route::post('/residence', [ResidenceController::class, 'store'])->name('residence.store');
Route::get('/residence/show', [ResidenceController::class, 'show'])->name('residence.show');
Route::get('/residence/history', [ResidenceController::class, 'history'])->name('residence.history');
Route::get('/residence/edit/{id}', [ResidenceController::class, 'edit'])->name('residence.edit');
Route::put('/residence/{residence}', [ResidenceController::class, 'update'])->name('residence.update');
Route::delete('/residence/{id}', [ResidenceController::class, 'destroy'])->name('residence.destroy');

//Payment
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/show', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
Route::put('/payment/{payment}', [PaymentController::class, 'update'])->name('payment.update');
Route::delete('/payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');