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

class ReportController extends Controller
{
    /**
     * Mostrar dashboard de reportes
     */
    public function index()
    {
        $reports = Report::with('user')
            ->orderBy('registrationDate', 'desc')
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Reporte de Ventas
     */
    public function salesReport(Request $request)
    {
        $query = Sale::with(['user', 'details.part']);

        // Filtros
        if ($request->filled('start_date')) {
            $query->whereDate('saleDate', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('saleDate', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sales = $query->orderBy('saleDate', 'desc')->get();

        // Estadísticas
        $totalSales = $sales->count();
        $totalRevenue = $sales->sum('total');
        $averageSale = $totalSales > 0 ? $totalRevenue / $totalSales : 0;

        return view('reports.sales', compact('sales', 'totalSales', 'totalRevenue', 'averageSale'));
    }

    /**
     * Reporte de Clientes
     */
    public function clientsReport(Request $request)
    {
        $query = User::withCount('motorcycles');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $clients = $query->orderBy('firstName')->get();

        $stats = [
            'total_clients' => $clients->count(),
            'active_clients' => $clients->where('status', 1)->count(),
            'clients_with_motorcycles' => $clients->where('motorcycles_count', '>', 0)->count()
        ];

        return view('reports.clients', compact('clients', 'stats'));
    }

    /**
     * Reporte de Motocicletas
     */
    public function motorcyclesReport(Request $request)
    {
        $query = Motorcycle::with(['user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        $motorcycles = $query->orderBy('brand')->get();

        $stats = [
            'total_motorcycles' => $motorcycles->count(),
            'active_motorcycles' => $motorcycles->where('status', 1)->count(),
            'brands' => $motorcycles->groupBy('brand')->map->count()
        ];

        return view('reports.motorcycles', compact('motorcycles', 'stats'));
    }

    /**
     * Reporte de Mantenimientos
     */
    public function maintenancesReport(Request $request)
    {
        $query = Maintenance::with(['motorcycle.user', 'mechanic']);

        // Aplicar filtros
        if ($request->filled('start_date')) {
            $query->whereDate('maintenanceDate', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('maintenanceDate', '<=', $request->end_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('mechanic_id')) {
            $query->where('idMechanic', $request->mechanic_id);
        }

        $maintenances = $query->orderBy('maintenanceDate', 'desc')->get();

        // Estadísticas
        $stats = [
            'total_maintenances' => $maintenances->count(),
            'completed_maintenances' => $maintenances->where('status', 'completed')->count(),
            'in_progress_maintenances' => $maintenances->where('status', 'in_progress')->count(),
            'pending_maintenances' => $maintenances->where('status', 'pending')->count(),
            'cancelled_maintenances' => $maintenances->where('status', 'cancelled')->count(),
            'total_cost' => $maintenances->sum('cost'),
            'mechanics' => $this->getMechanicsStats($maintenances),
        ];

        $mechanics = User::where('role', 'mechanic')->get();

        return view('reports.maintenances', compact('maintenances', 'stats', 'mechanics'));
    }

    /**
     * Reporte de Reservas
     */
    public function reservationsReport(Request $request)
    {
        // Cambiar la consulta para cargar usuario a través de motorcycle
        $query = Reservation::with(['motorcycle.user']); // <- Aquí está el cambio

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

        // Estadísticas
        $stats = [
            'total_reservations' => $reservations->count(),
            'confirmed_reservations' => $reservations->where('status', 'confirmed')->count(),
            'pending_reservations' => $reservations->where('status', 'pending')->count(),
            'completed_reservations' => $reservations->where('status', 'completed')->count(),
            'cancelled_reservations' => $reservations->where('status', 'cancelled')->count(),
            'maintenance_reservations' => $reservations->where('serviceType', 'maintenance')->count(),
            'repair_reservations' => $reservations->where('serviceType', 'repair')->count(),
            'inspection_reservations' => $reservations->where('serviceType', 'inspection')->count(),
            'other_reservations' => $reservations->where('serviceType', 'other')->count(),
            'confirmation_rate' => $reservations->count() > 0 ? 
                round(($reservations->where('status', 'confirmed')->count() / $reservations->count()) * 100, 2) : 0,
        ];

        return view('reports.reservations', compact('reservations', 'stats'));
    }

    /**
     * Reporte de Inventario
     */
    public function inventoryReport(Request $request)
    {
        $query = Store::query();

        // Aplicar filtros
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('stock_status')) {
            if ($request->stock_status == 'low') {
                $query->where('stock', '<', 10)->where('stock', '>', 0);
            } elseif ($request->stock_status == 'out') {
                $query->where('stock', 0);
            } elseif ($request->stock_status == 'normal') {
                $query->where('stock', '>=', 10);
            }
        }

        if ($request->filled('supplier')) {
            $query->where('supplier', 'like', '%' . $request->supplier . '%');
        }

        $products = $query->orderBy('name')->get();

        // Estadísticas
        $stats = [
            'total_products' => $products->count(),
            'total_value' => $products->sum(function($product) {
                return $product->stock * $product->price;
            }),
            'low_stock' => $products->where('stock', '<', 10)->where('stock', '>', 0)->count(),
            'out_of_stock' => $products->where('stock', 0)->count(),
            'categories' => $products->groupBy('category')->map->count(),
            'low_stock_products' => $products->where('stock', '<', 10)->where('stock', '>', 0),
        ];

        return view('reports.inventory', compact('products', 'stats'));
    }

    /**
     * Obtener estadísticas de mecánicos
     */
    private function getMechanicsStats($maintenances)
    {
        $mechanicsData = $maintenances->groupBy('idMechanic')->map(function($group, $mechanicId) {
            $mechanic = $group->first()->mechanic;
            return [
                'name' => $mechanic ? $mechanic->firstName . ' ' . $mechanic->lastName : 'N/A',
                'count' => $group->count()
            ];
        });

        return $mechanicsData->values();
    }
}