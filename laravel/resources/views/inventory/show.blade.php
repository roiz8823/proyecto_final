 @extends('admin.layouts.master')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-info text-white">
                        <h3 class="text-center font-weight-light my-4">
                            <i class="fas fa-info-circle me-2"></i> Detalles del Repuesto
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6 text-center">
                                <div class="mb-3">
                                    <i class="fas fa-box fa-4x text-primary"></i>
                                </div>
                                <h4 class="fw-bold">{{ $inventory->name }}</h4>
                                <h5 class="text-muted">{{ $inventory->idPart }}</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="alert 
                                    @if($inventory->status == 1) alert-success
                                    @elseif($inventory->status == 0) alert-danger
                                    @else alert-warning @endif">
                                    <strong>Estado:</strong> 
                                    @if($inventory->status == 1) Disponible
                                    @elseif($inventory->status == 0) Agotado
                                    @else En Pedido @endif
                                </div>
                                <div class="alert alert-secondary">
                                    <strong>Categoría:</strong> {{ $inventory->category }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card bg-light mb-3">
                                    <div class="card-header">Stock</div>
                                    <div class="card-body">
                                        <h2 class="text-center">{{ $inventory->stock }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light mb-3">
                                    <div class="card-header">Precio</div>
                                    <div class="card-body">
                                        <h2 class="text-center">{{ number_format($inventory->price, 2) }} Bs</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light mb-3">
                                    <div class="card-header">Fecha Registro</div>
                                    <div class="card-body">
                                        <h5 class="text-center">{{ date('d/m/Y', strtotime($inventory->registrationDate)) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-file-alt me-1"></i>
                                Descripción Técnica
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $inventory->description }}</p>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('inventory.edit', $inventory->idPart) }}" class="btn btn-warning me-md-2">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                            <form action="{{ route('inventory.destroy', $inventory->idPart) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este repuesto?')">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            </form>
                            <a href="{{ route('inventory.index') }}" class="btn btn-secondary ms-2">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection