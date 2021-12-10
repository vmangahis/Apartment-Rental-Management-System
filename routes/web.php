<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\MailController;


//Login
Route::get('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/login/check', [LoginController::class, 'checkLogin']);




// To implement mailing send
Route::get('/send', [MailController::class, 'send']);

Route::group(['middleware' => ['adminAuth']],  function() {
    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('main');

//Expenses
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
    Route::get('/expenses/monthly/report/{year}/{month}', [ExpenseController::class, 'getMonthlyReport']);
    Route::get('/expenses/annual/report/{year}', [ExpenseController::class, 'getAnnualReport']);
    Route::post('/expenses', [ExpenseController::class, 'addrecord']);

//Payment
    Route::get('/payment/',[PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/tenant',[PaymentController::class, 'addPayment']);
    Route::get('/payment/report/{year}/{month}',[PaymentController::class, 'getMonthly']);
    Route::get('/payment/report/{year}',[PaymentController::class, 'getAnnual']);

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

});



