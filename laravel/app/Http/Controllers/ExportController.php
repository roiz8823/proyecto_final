<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Motorcycle;
use App\Models\Maintenance;
use App\Models\Reservation;
use App\Models\Store;
use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    /**
     * Exportar Reporte de Ventas a PDF
     */
    public function exportSalesPDF(Request $request)
    {
        $query = Sale::with(['user', 'details.part']);

        // Aplicar mismos filtros que en el reporte
        if ($request->filled('start_date')) {
            $query->whereDate('saleDate', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('saleDate', '<=', $request->end_date);
        }

        $sales = $query->orderBy('saleDate', 'desc')->get();

        $data = [
            'sales' => $sales,
            'totalSales' => $sales->count(),
            'totalRevenue' => $sales->sum('total'),
            'averageSale' => $sales->count() > 0 ? $sales->sum('total') / $sales->count() : 0,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'generatedBy' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        // Guardar registro del reporte
        $report = Report::create([
            'idUser' => Auth::id(),
            'reportType' => 'sales',
            'parameters' => $request->all(),
            'registrationDate' => now()
        ]);

        $pdf = Pdf::loadView('exports.sales-pdf', $data);
        return $pdf->download('reporte-ventas-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar Reporte de Clientes a PDF
     */
    public function exportClientsPDF(Request $request)
    {
        $query = User::withCount('motorcycles');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $clients = $query->orderBy('firstName')->get();

        $data = [
            'clients' => $clients,
            'totalClients' => $clients->count(),
            'activeClients' => $clients->where('status', 1)->count(),
            'clientsWithMotorcycles' => $clients->where('motorcycles_count', '>', 0)->count(),
            'generatedBy' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        $report = Report::create([
            'idUser' => Auth::id(),
            'reportType' => 'clients',
            'parameters' => $request->all(),
            'registrationDate' => now()
        ]);

        $pdf = Pdf::loadView('exports.clients-pdf', $data);
        return $pdf->download('reporte-clientes-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar Reporte de Motocicletas a PDF
     */
    public function exportMotorcyclesPDF(Request $request)
    {
        $query = Motorcycle::with(['user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $motorcycles = $query->orderBy('brand')->get();

        $data = [
            'motorcycles' => $motorcycles,
            'totalMotorcycles' => $motorcycles->count(),
            'activeMotorcycles' => $motorcycles->where('status', 1)->count(),
            'brands' => $motorcycles->groupBy('brand')->map->count(),
            'generatedBy' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        $report = Report::create([
            'idUser' => Auth::id(),
            'reportType' => 'motorcycles',
            'parameters' => $request->all(),
            'registrationDate' => now()
        ]);

        $pdf = Pdf::loadView('exports.motorcycles-pdf', $data);
        return $pdf->download('reporte-motocicletas-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar Reporte de Mantenimientos a PDF
     */
    public function exportMaintenancesPDF(Request $request)
    {
        $query = Maintenance::with(['motorcycle.user', 'mechanic']);

        if ($request->filled('start_date')) {
            $query->whereDate('maintenanceDate', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('maintenanceDate', '<=', $request->end_date);
        }

        $maintenances = $query->orderBy('maintenanceDate', 'desc')->get();

        $data = [
            'maintenances' => $maintenances,
            'totalMaintenances' => $maintenances->count(),
            'totalCost' => $maintenances->sum('cost'),
            'byStatus' => $maintenances->groupBy('status')->map->count(),
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'generatedBy' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        $report = Report::create([
            'idUser' => Auth::id(),
            'reportType' => 'maintenances',
            'parameters' => $request->all(),
            'registrationDate' => now()
        ]);

        $pdf = Pdf::loadView('exports.maintenances-pdf', $data);
        return $pdf->download('reporte-mantenimientos-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar Reporte de Reservas a PDF
     */
    public function exportReservationsPDF(Request $request)
    {
        $query = Reservation::with(['motorcycle.user']);

        // Aplicar filtros
        if ($request->filled('start_date')) {
            $query->whereDate('reservationDate', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('reservationDate', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('serviceType', $request->service_type);
        }

        $reservations = $query->orderBy('reservationDate', 'desc')->get();

        $data = [
            'reservations' => $reservations,
            'totalReservations' => $reservations->count(),
            'confirmedReservations' => $reservations->where('status', 'confirmed')->count(),
            'pendingReservations' => $reservations->where('status', 'pending')->count(),
            'completedReservations' => $reservations->where('status', 'completed')->count(),
            'cancelledReservations' => $reservations->where('status', 'cancelled')->count(),
            'confirmationRate' => $reservations->count() > 0 ? 
                round(($reservations->where('status', 'confirmed')->count() / $reservations->count()) * 100, 2) : 0,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'generatedBy' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        // Guardar registro del reporte
        $report = Report::create([
            'idUser' => Auth::id(),
            'reportType' => 'reservations',
            'parameters' => $request->all(),
            'registrationDate' => now()
        ]);

        $pdf = Pdf::loadView('exports.reservations-pdf', $data);
        return $pdf->download('reporte-reservas-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Exportar Reporte de Inventario a PDF
     */
    public function exportInventoryPDF(Request $request)
    {
        $query = Store::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->orderBy('name')->get();

        $data = [
            'products' => $products,
            'totalProducts' => $products->count(),
            'totalStock' => $products->sum('stock'),
            'totalValue' => $products->sum(function($product) {
                return $product->stock * $product->price;
            }),
            'lowStock' => $products->where('stock', '<', 10)->where('stock', '>', 0)->count(),
            'outOfStock' => $products->where('stock', 0)->count(),
            'generatedBy' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        $report = Report::create([
            'idUser' => Auth::id(),
            'reportType' => 'inventory',
            'parameters' => $request->all(),
            'registrationDate' => now()
        ]);

        $pdf = Pdf::loadView('exports.inventory-pdf', $data);
        return $pdf->download('reporte-inventario-' . now()->format('Y-m-d') . '.pdf');
    }

    
    /**
     * Exportar Recibo de Mantenimiento Individual
     */
    public function exportMaintenanceReceiptPDF($id)
    {
        $maintenance = Maintenance::with(['motorcycle.user', 'mechanic'])->findOrFail($id);
        
        $data = [
            'maintenance' => $maintenance,
            'generatedAt' => now()->format('d/m/Y H:i')
        ];

        $pdf = Pdf::loadView('exports.maintenance-receipt-pdf', $data);
        
        $filename = 'recibo-mantenimiento-' . $maintenance->idMaintenance . '-' . now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
}