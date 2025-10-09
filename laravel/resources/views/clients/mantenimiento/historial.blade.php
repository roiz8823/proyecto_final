@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-clipboard-list me-2"></i>Historial de Mantenimiento
        </h1>
        <p class="page-subtitle">Revisa el historial completo de servicios de tus motocicletas</p>
    </div>

    <!-- Filtros -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Filtrar por estado:</label>
                <select class="form-select" id="statusFilter">
                    <option value="">Todos los estados</option>
                    <option value="0">Pendiente</option>
                    <option value="1">En Progreso</option>
                    <option value="2">Completado</option>
                    <option value="3">Cancelado</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Buscar:</label>
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar en diagnóstico...">
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de Mantenimientos -->
    <div class="items-grid" id="maintenancesGrid">
        @forelse($maintenances as $maintenance)
        <div class="item-card maintenance-card" 
             data-status="{{ $maintenance->status }}"
             data-diagnosis="{{ strtolower($maintenance->diagnosis) }}">
            <div class="item-card-header">
                <h4 class="item-card-title">{{ $maintenance->motorcycle->brand }} {{ $maintenance->motorcycle->model }}</h4>
                <div class="item-card-icon">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
            
            <div class="mb-3">
                <span class="badge-custom badge-{{ $maintenance->status_class }}">
                    {{ $maintenance->status_text }}
                </span>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Fecha:</small>
                <p class="mb-1 fw-bold">{{ $maintenance->maintenanceDate->format('d/m/Y') }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Diagnóstico:</small>
                <p class="mb-1">{{ Str::limit($maintenance->diagnosis, 100) }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Mecánico:</small>
                <p class="mb-1">{{ $maintenance->mechanic->firstName ?? 'No asignado' }} {{ $maintenance->mechanic->lastName ?? '' }}</p>
            </div>
            
            <div class="mb-3">
                <small class="text-muted">Costo:</small>
                <p class="mb-1 fw-bold text-success">{{ $maintenance->formatted_cost ?? 'Bs ' . number_format($maintenance->cost, 2) }}</p>
            </div>

            <a href="{{ route('cliente.mantenimiento.show', $maintenance) }}" 
            class="btn btn-primary-custom w-100">
                <i class="fas fa-eye me-1"></i> Ver Detalles
            </a>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-tools empty-state-icon"></i>
                <h4 class="empty-state-title">No hay mantenimientos registrados</h4>
                <p class="empty-state-text">Los mantenimientos aparecerán aquí una vez que sean programados</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        <div class="pagination-custom">
            {{ $maintenances->links() }}
        </div>
    </div>
</div>

<!-- Modal Detalles Mantenimiento -->
<div class="modal fade modal-custom" id="detallesMantenimientoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Mantenimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detallesMantenimientoContent">
                <!-- Contenido cargado por JavaScript -->
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Filtros
    $('#statusFilter, #searchInput').on('change input', function() {
        filterMaintenances();
    });

    function filterMaintenances() {
        var status = $('#statusFilter').val();
        var search = $('#searchInput').val().toLowerCase();
        
        $('.maintenance-card').each(function() {
            var cardStatus = $(this).data('status');
            var cardDiagnosis = $(this).data('diagnosis');
            
            var statusMatch = status === '' || cardStatus == status;
            var searchMatch = search === '' || cardDiagnosis.includes(search);
            
            if (statusMatch && searchMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Modal de detalles
    $('#detallesMantenimientoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var maintenance = button.data('maintenance');
        var modal = $(this);
        
        var content = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Información General</h6>
                    <table class="table table-sm">
                        <tr><td><strong>Motocicleta:</strong></td><td>${maintenance.motorcycle}</td></tr>
                        <tr><td><strong>Placa:</strong></td><td>${maintenance.licensePlate}</td></tr>
                        <tr><td><strong>Fecha:</strong></td><td>${maintenance.maintenanceDate}</td></tr>
                        <tr><td><strong>Estado:</strong></td><td><span class="badge-custom badge-${maintenance.status_class}">${maintenance.status}</span></td></tr>
                        <tr><td><strong>Mecánico:</strong></td><td>${maintenance.mechanic}</td></tr>
                        <tr><td><strong>Costo:</strong></td><td class="fw-bold text-success">${maintenance.cost}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Detalles del Servicio</h6>
                    <p><strong>Diagnóstico:</strong><br>${maintenance.diagnosis}</p>
                    ${maintenance.serviceDetails ? `<p><strong>Servicios Realizados:</strong><br>${maintenance.serviceDetails}</p>` : ''}
                    ${maintenance.partsUsed ? `<p><strong>Partes Utilizadas:</strong><br>${maintenance.partsUsed}</p>` : ''}
                    ${maintenance.notes ? `<p><strong>Notas:</strong><br>${maintenance.notes}</p>` : ''}
                </div>
            </div>
        `;
        
        modal.find('#detallesMantenimientoContent').html(content);
    });
</script>

<style>
.maintenance-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.maintenance-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
@endsection