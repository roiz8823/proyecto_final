<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MaintenanceController;



Route::get('/', function () {
    return view('pag');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// creando rutas protegidas por rol
// Rutas para administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('users', UserController::class);
});

// Rutas para mecanico
Route::middleware(['auth', 'role:mechanic'])->group(function () {
    Route::get('/mechanic/dashboard', function () {
        return view('mechanic.dashboard');
    });
});

// Rutas para cliente
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/clients/dashboard', function () {
        return view('clients.dashboard');
    });
});

// Rutas para motocicletas
Route::resource('motorcycles', MotorcycleController::class);

// Rutas para clientes
Route::get('/clients', [UserController::class, 'clients']);

// Rutas para mecanicos
Route::get('/mechanic', [UserController::class, 'mechanics']);

// Rutas para inventario
Route::resource('inventory', InventoryController::class);

// rutas de mantenimiento
Route::resource('maintenances', MaintenanceController::class);
