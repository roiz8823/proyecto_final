@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-cog me-2"></i>Repuestos Disponibles
        </h1>
        <p class="page-subtitle">Consulta todos los repuestos disponibles en el taller</p>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Filtrar por categoría:</label>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('cliente.repuestos') }}" class="btn btn-primary-custom btn-sm">
                        Todas las Categorías
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('cliente.repuestos.categoria', $category) }}" 
                           class="btn btn-outline-secondary btn-sm">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Buscar repuesto:</label>
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control" id="searchRepuestos" placeholder="Nombre del repuesto...">
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Stock -->
    <div class="alert alert-info-custom d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-info-circle me-2"></i>
            <strong>Mostrando {{ $repuestos->count() }} repuestos disponibles</strong>
        </div>
        @if($repuestos->where('stock', '<', 10)->count() > 0)
        <span class="badge-custom badge-warning">
            <i class="fas fa-exclamation-triangle me-1"></i>
            {{ $repuestos->where('stock', '<', 10)->count() }} con stock bajo
        </span>
        @endif
    </div>

    <!-- Grid de Repuestos -->
    <div class="items-grid" id="repuestosGrid">
        @forelse($repuestos as $repuesto)
        <div class="item-card repuesto-item {{ $repuesto->low_stock ? 'border-warning' : '' }}" 
             data-name="{{ strtolower($repuesto->name) }}"
             data-category="{{ strtolower($repuesto->category) }}">
            
            @if($repuesto->low_stock)
            <div class="alert alert-warning-custom small mb-3 py-2">
                <i class="fas fa-exclamation-triangle me-1"></i>
                <strong>Stock Bajo</strong>
            </div>
            @endif
            
            <div class="item-card-header">
                <h4 class="item-card-title">{{ $repuesto->name }}</h4>
                <div class="item-card-icon">
                    <i class="fas fa-cog"></i>
                </div>
            </div>
            
            <div class="text-center mb-3">
                <span class="badge-custom badge-info">{{ $repuesto->category }}</span>
            </div>
            
            <div class="text-center mb-3">
                <h3 class="text-success mb-1">${{ number_format($repuesto->price, 2) }}</h3>
                <small class="text-muted">Precio unitario</small>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="{{ $repuesto->low_stock ? 'text-danger fw-bold' : 'text-muted' }}">
                    <i class="fas fa-boxes me-1"></i>
                    Stock: {{ $repuesto->stock }} unidades
                </span>
                @if($repuesto->low_stock)
                <span class="badge-custom badge-danger">¡Bajo Stock!</span>
                @endif
            </div>

            @if($repuesto->description)
            <div class="mb-3">
                <small class="text-muted">Descripción:</small>
                <p class="mb-1 small">{{ Str::limit($repuesto->description, 80) }}</p>
            </div>
            @endif
            
            <div class="card-footer-custom bg-transparent text-center pt-3">
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    Disponible desde {{ $repuesto->registrationDate->format('d/m/Y') }}
                </small>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-cogs empty-state-icon"></i>
                <h4 class="empty-state-title">No hay repuestos disponibles</h4>
                <p class="empty-state-text">Vuelve más tarde para ver los repuestos en stock</p>
                <a href="{{ route('cliente.dashboard') }}" class="btn btn-primary-custom">
                    <i class="fas fa-arrow-left me-1"></i> Volver al Dashboard
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        <div class="pagination-custom">
            {{ $repuestos->links() }}
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Búsqueda en tiempo real
    $('#searchRepuestos').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('.repuesto-item').each(function() {
            var repuestoName = $(this).data('name');
            var repuestoCategory = $(this).data('category');
            
            if (repuestoName.includes(searchTerm) || repuestoCategory.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
</script>

<style>
.repuesto-item {
    transition: all 0.3s ease;
}

.repuesto-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.card-footer-custom {
    border-top: 1px solid rgba(0,0,0,0.05);
    padding-top: 15px;
}
</style>
@endsection
@endsection