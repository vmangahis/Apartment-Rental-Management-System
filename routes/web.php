<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\MailController;


//GET Request
Route::get('/', [DashboardController::class, 'index']); //dashboard

Route::get('/payment', [ExpenseController::class, 'index'])->name('payment'); //expenses

Route::get('/payment/tenant',[PaymentController::class, 'index'])->name('tenantpayment'); //payments

Route::get('/tenants', [TenantController::class, 'index'])->name('tenants'); // Tenant

Route::get('/tenants/archived', [TenantController::class, 'filter'])->name('archived-tenants');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/searchtenant', [TenantController::class, 'search_tenants']); // Search Tenant

Route::get('/rooms',[RoomController::class, 'index'])->name('room');//Room

Route::get('/rooms/occupied',[RoomController::class, 'occupied'])->name('occupied_room'); // Occupied Room

Route::get('/report',[ReportsController::class, 'index'])->name('report');



Route::get('/send', [MailController::class, 'send']);

//POST
Route::post('/profile/password', [ProfileController::class, 'change_password']);

Route::post('/tenants', [TenantController::class, 'register']);

Route::post('/profile/update', [ProfileController::class, 'edit']);

Route::post('/edittenants', [TenantController::class, 'edit']);

Route::post('/rooms', [RoomController::class, 'addroom']);


//DELETE
Route::delete('/tenants', [TenantController::class, 'destroy']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
