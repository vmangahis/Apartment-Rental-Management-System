<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/payment', [ExpenseController::class, 'index'])->name('payment');

Route::get('/payment/tenant',[PaymentController::class, 'index'])->name('tenantpayment');

Route::post('/tenants', [TenantController::class, 'register']);

Route::delete('/tenants', [TenantController::class, 'destroy']);

Route::get('/tenants', [TenantController::class, 'index'])->name('tenants');

