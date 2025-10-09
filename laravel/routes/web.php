<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ReservationController;



Route::get('/', function () {
    return view('index');
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
// Rutas públicas (sin autenticación)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [UserController::class, 'registerClient'])->name('register.store');

// Ruta de inicio pública
Route::get('/', function () {
    return view('index');
});

// Rutas para motocicletas
Route::resource('motorcycles', MotorcycleController::class);

// Rutas para clientes
Route::get('/clients', [UserController::class, 'clients']);

// Rutas para mecanicos
Route::get('/mechanic', [UserController::class, 'mechanics']);

// rutas de mantenimiento
Route::resource('maintenances', MaintenanceController::class);

// rutas de reserva
Route::resource('reservations', ReservationController::class);
Route::post('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])
    ->name('reservations.updateStatus');

// rutas de Almancen
Route::resource('store', StoreController::class);
Route::post('/store/{store}/stock', [StoreController::class, 'updateStock'])->name('store.updateStock');
Route::get('/store/category/{category}', [StoreController::class, 'byCategory'])->name('store.byCategory');

// Rutas para Clientes
Route::prefix('clients')->name('cliente.')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    
// Reservas - CORREGIDAS
    Route::get('/reservas', [ClientController::class, 'reservas'])->name('reservas');
    Route::get('/reservas/nueva', [ClientController::class, 'createReserva'])->name('reservas.create');
    Route::get('/reservas/{reservation}/editar', [ClientController::class, 'editReserva'])->name('reservas.edit');
    Route::post('/reservas', [ClientController::class, 'storeReserva'])->name('reservas.store');
    Route::put('/reservas/{reservation}', [ClientController::class, 'updateReserva'])->name('reservas.update');
    Route::delete('/reservas/{reservation}', [ClientController::class, 'cancelReserva'])->name('reservas.cancel');
    
    // Historial de Mantenimiento
    Route::get('/historial-mantenimiento', [ClientController::class, 'historialMantenimiento'])->name('mantenimiento.historial');
    Route::get('/mantenimiento/{maintenance}', [ClientController::class, 'showMantenimiento'])->name('mantenimiento.show');

    // Mis Motocicletas
    Route::get('/mis-motocicletas', [ClientController::class, 'misMotocicletas'])->name('motocicletas');
    Route::get('/mis-motocicletas/{motorcycle}', [ClientController::class, 'showMotocicleta'])->name('motocicletas.show');
    Route::get('/mis-motocicletas/crear', [ClientController::class, 'createMotocicleta'])->name('motocicletas.create');
    Route::post('/mis-motocicletas/guardar', [ClientController::class, 'storeMotocicleta'])->name('motocicletas.store');

    // Repuestos
    Route::get('/repuestos', [ClientController::class, 'repuestos'])->name('repuestos');
    Route::get('/repuestos/categoria/{category}', [ClientController::class, 'repuestosPorCategoria'])->name('repuestos.categoria');
});

