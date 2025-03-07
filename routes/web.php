<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeliveriesController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [AdminController::class, 'index'])->name('admin');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/truckNdriver', [AdminController::class, 'truckNdriver'])->name('truckNdriver');

Route::get('/api/getTruckDetails/{truckId}', [TruckController::class, 'getTruckDetails']);

Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
Route::get('/delivery', [AdminController::class, 'delivery'])->name('delivery');
// Route::get('/reports', [AdminController::class, 'reports'])->name('reports'); //deliveries
Route::get('/reports', [AdminController::class, 'report'])->name('reports'); //groupclient

//truckss
Route::post('/trucks', [TruckController::class, 'store'])->name('trucks.store');
Route::get('/trucks-view', [TruckController::class, 'index'])->name('truck-index');
Route::get('/trucks/{id}', [TruckController::class, 'show'])->name('trucks.show'); 
Route::get('/trucks/{id}/edit', [TruckController::class, 'edit']);
Route::put('/trucks/{id}', [TruckController::class, 'update'])->name('trucks.update');
Route::delete('/trucks/{truck}', [TruckController::class, 'destroy'])->name('trucks.destroy');


//clients
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients-view', [ClientController::class, 'index'])->name('client-index');
//Route::get('/clients/{id}', [TruckController::class, 'show2'])->name('client.show2'); 
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');

Route::get('/clients/{id}/edit', [ClientController::class, 'edit']);
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

//delivery
Route::get('/deleviries', [DeliveriesController::class,'index'])->name('delivery-index');
//Route::post('/delivery-store', [DeliveriesController::class,'store'])->name('delivery-store');
Route::post('/delivery-store', [DeliveriesController::class, 'store'])->name('delivery-store');

Route::post('/delivery/update-status', [DeliveriesController::class, 'updateStatus'])->name('delivery-update-status');
Route::get('/delivery/{id}/edit', [DeliveriesController::class, 'edit'])->name('delivery.edit');
Route::put('/delivery/{id}', [DeliveriesController::class, 'update'])->name('delivery.update');
Route::delete('/delivery/{id}', [DeliveriesController::class, 'destroy'])->name('delivery.destroy');

// web.php
Route::post('/update-client/{id}', [AdminController::class, 'updateClient']);
//Route::get('/reports', [ReportController::class, 'ReportIndex'])->name('report-index');
