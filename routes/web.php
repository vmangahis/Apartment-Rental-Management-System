<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SummaryController;


//GET Request
Route::get('/', [DashboardController::class, 'index']); //dashboard

Route::get('/payment', [ExpenseController::class, 'index'])->name('payment'); //expenses

Route::get('/payment/tenant',[PaymentController::class, 'index'])->name('tenantpayment'); //payments

Route::get('/tenants', [TenantController::class, 'index'])->name('tenants'); // Tenant

Route::get('/rooms',[RoomController::class, 'index'])->name('room'); //Room

Route::get('/report',[ReportsController::class, 'index'])->name('report');

Route::get('/summary',[SummaryController::class, 'index'])->name('summary');

//POST
Route::post('/tenants', [TenantController::class, 'register']);

//PUT

//Route::put('/tenants', [TenantController::class, 'edit']);

//DELETE
Route::delete('/tenants', [TenantController::class, 'destroy']);



