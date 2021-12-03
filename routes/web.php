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


//Dashboard
Route::get('/', [DashboardController::class, 'index']);

//Expenses
Route::get('/payment', [ExpenseController::class, 'index'])->name('payment');

Route::post('/payment', [ExpenseController::class, 'addrecord']);

//Payment

Route::get('/payment/tenant',[PaymentController::class, 'index'])->name('tenantpayment');

Route::post('/payment/tenant',[PaymentController::class, 'addPayment']);



//Tenants
Route::get('/tenants', [TenantController::class, 'index'])->name('tenants'); // Tenant

Route::get('/tenants/archived', [TenantController::class, 'filter'])->name('archived-tenants');

Route::get('/searchtenant', [TenantController::class, 'search_tenants']);

Route::post('/tenants', [TenantController::class, 'register']);

Route::post('/edittenants', [TenantController::class, 'edit']);

Route::delete('/tenants', [TenantController::class, 'destroy']);


//Landlord Profile

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/profile/password', [ProfileController::class, 'change_password']);

Route::post('/profile/username', [ProfileController::class, 'change_username']);

Route::post('/profile/update', [ProfileController::class, 'edit']);


//Rooms
Route::get('/rooms',[RoomController::class, 'index'])->name('room');

Route::post('/rooms', [RoomController::class, 'addroom']);

Route::get('/rooms/occupied',[RoomController::class, 'occupied'])->name('occupied_room'); // Occupied Room

Route::get('/report',[ReportsController::class, 'index'])->name('report');


// To implement mailing send
Route::get('/send', [MailController::class, 'send']);



Auth::routes();

