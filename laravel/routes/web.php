<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\MechaniController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExportController;



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

  // Mi Perfil
Route::get('/clients/mi-perfil', [ClientController::class, 'miPerfil'])->name('cliente.perfil');
Route::get('/clients/editar-perfil', [ClientController::class, 'editarPerfil'])->name('cliente.perfil.edit');
Route::post('/clients/actualizar-perfil', [ClientController::class, 'actualizarPerfil'])->name('cliente.perfil.update');
Route::get('/clients/cambiar-password', [ClientController::class, 'cambiarPassword'])->name('cliente.password.edit');
Route::post('/clients/actualizar-password', [ClientController::class, 'actualizarPassword'])->name('cliente.password.update');
});

// Rutas públicas (sin autenticación)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [UserController::class, 'registerClient'])->name('register.store');

// Rutas para motocicletas
Route::resource('motorcycles', MotorcycleController::class);

// Rutas para clientes
Route::get('/clients', [UserController::class, 'clients']);

// Rutas para mecanicos
Route::get('/mechanic', [UserController::class, 'mechanics']);

// rutas de mantenimiento
Route::resource('maintenances', MaintenanceController::class);
Route::get('maintenances/{id}/export-pdf', [MaintenanceController::class, 'exportPDF'])->name('maintenances.export-pdf');

// rutas de reserva
Route::resource('reservations', ReservationController::class);
Route::post('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])
    ->name('reservations.updateStatus');

// rutas de Almancen
Route::resource('store', StoreController::class);
Route::post('/store/{store}/stock', [StoreController::class, 'updateStock'])->name('store.updateStock');
Route::get('/store/category/{category}', [StoreController::class, 'byCategory'])->name('store.byCategory');

// rutas de ventas
Route::resource('sales', SaleController::class);
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
Route::get('/sales/{id}', [SaleController::class, 'show'])->name('sales.show');
Route::get('/sales/{id}/edit', [SaleController::class, 'edit'])->name('sales.edit');
Route::put('/sales/{id}', [SaleController::class, 'update'])->name('sales.update');
Route::delete('/sales/{id}', [SaleController::class, 'destroy'])->name('sales.destroy');

// Reportes
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/sales', [ReportController::class, 'salesReport'])->name('sales');
    Route::get('/clients', [ReportController::class, 'clientsReport'])->name('clients');
    Route::get('/motorcycles', [ReportController::class, 'motorcyclesReport'])->name('motorcycles');
    Route::get('/maintenances', [ReportController::class, 'maintenancesReport'])->name('maintenances');
    Route::get('/reservations', [ReportController::class, 'reservationsReport'])->name('reservations');
    Route::get('/inventory', [ReportController::class, 'inventoryReport'])->name('inventory');
});

// Exportaciones
Route::prefix('exports')->name('exports.')->group(function () {
    Route::get('/sales/pdf', [ExportController::class, 'exportSalesPDF'])->name('sales.pdf');
    Route::get('/clients/pdf', [ExportController::class, 'exportClientsPDF'])->name('clients.pdf');
    Route::get('/motorcycles/pdf', [ExportController::class, 'exportMotorcyclesPDF'])->name('motorcycles.pdf');
    Route::get('/maintenances/pdf', [ExportController::class, 'exportMaintenancesPDF'])->name('maintenances.pdf');
    Route::get('/reservations/pdf', [ExportController::class, 'exportReservationsPDF'])->name('reservations.pdf');
    Route::get('/inventory/pdf', [ExportController::class, 'exportInventoryPDF'])->name('inventory.pdf');

    Route::get('maintenances/{id}/export-pdf', [ExportController::class, 'exportMaintenanceReceiptPDF'])->name('maintenances.export-pdf');
});

// Rutas para Clientes
Route::prefix('clients')->name('cliente.')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    
// Reservas - 
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
    Route::get('/mis-motocicletas/crear', [ClientController::class, 'createMotocicleta'])->name('motocicletas.create');
    Route::get('/mis-motocicletas/{motorcycle}', [ClientController::class, 'showMotocicleta'])->name('motocicletas.show');
    Route::post('/mis-motocicletas/guardar', [ClientController::class, 'storeMotocicleta'])->name('motocicletas.store');

    // Repuestos
    Route::get('/repuestos', [ClientController::class, 'repuestos'])->name('repuestos');
    Route::get('/repuestos/categoria/{category}', [ClientController::class, 'repuestosPorCategoria'])->name('repuestos.categoria');
});


// Rutas del Mecánico
Route::prefix('mechanic')->name('mechanic.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MechaniController::class, 'dashboard'])->name('dashboard');
    
    // Clientes
    Route::get('/clients', [MechaniController::class, 'clients'])->name('clients.index');
    Route::get('/clients/{client}', [MechaniController::class, 'showClient'])->name('clients.show');
    
    // Motocicletas
    Route::get('/motorcycles', [MechaniController::class, 'motorcycles'])->name('motorcycles.index');
    Route::get('/motorcycles/{motorcycle}', [MechaniController::class, 'showMotorcycle'])->name('motorcycles.show'); 
   



    // Mantenimientos
    Route::get('/maintenances', [MechaniController::class, 'maintenances'])->name('maintenances.index');
    Route::get('/maintenances/create', [MechaniController::class, 'createMaintenance'])->name('maintenances.create');
    Route::post('/maintenances', [MechaniController::class, 'storeMaintenance'])->name('maintenances.store');
    Route::get('/maintenances/{maintenance}', [MechaniController::class, 'showMaintenance'])->name('maintenances.show');

    // Reservas
    Route::get('/reservations', [MechaniController::class, 'reservations'])->name('reservations.index');
    Route::get('/reservations/create', [MechaniController::class, 'createReservation'])->name('reservations.create');
    Route::post('/reservations', [MechaniController::class, 'storeReservation'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [MechaniController::class, 'showReservation'])->name('reservations.show');
    Route::post('/reservations/{reservation}/status', [MechaniController::class, 'updateReservationStatus'])->name('reservations.updateStatus'); 

    // Almacén
    Route::get('/store', [MechaniController::class, 'store'])->name('store.index');
    Route::get('/store/category/{category}', [MechaniController::class, 'productsByCategory'])->name('store.category');
    Route::get('/store/{product}', [MechaniController::class, 'showProduct'])->name('store.show');
    
    // Ventas
    Route::get('/sales', [MechaniController::class, 'sales'])->name('sales.index');
    Route::get('/sales/create', [MechaniController::class, 'createSale'])->name('sales.create');
    Route::post('/sales', [MechaniController::class, 'storeSale'])->name('sales.store');
    Route::get('/sales/{sale}', [MechaniController::class, 'showSale'])->name('sales.show');

    // Perfil del Mecánico
    Route::get('/profile', [MechaniController::class, 'profile'])->name('profile');
    
});

