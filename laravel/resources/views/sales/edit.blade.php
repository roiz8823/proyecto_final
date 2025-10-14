@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Venta</h1>
    
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
        <li class="breadcrumb-item active">Editar Venta #{{ $sale->idSale }}</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>Editar Venta #{{ $sale->idSale }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sales.update', $sale->idSale) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idUser" class="form-label">Cliente *</label>
                            <select class="form-select @error('idUser') is-invalid @enderror" 
                                    id="idUser" name="idUser" required>
                                <option value="">Seleccionar Cliente</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->idUser }}" 
                                        {{ old('idUser', $sale->idUser) == $user->idUser ? 'selected' : '' }}>
                                        {{ $user->firstName }} {{ $user->lastName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idUser')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idMechanic" class="form-label">Mecánico *</label>
                            <select class="form-select @error('idMechanic') is-invalid @enderror" 
                                    id="idMechanic" name="idMechanic" required>
                                <option value="">Seleccionar Mecánico</option>
                                @foreach($mechanics as $mechanic)
                                    <option value="{{ $mechanic->idMechanic }}" 
                                        {{ old('idMechanic', $sale->idMechanic) == $mechanic->idMechanic ? 'selected' : '' }}>
                                        {{ $mechanic->firstName }} {{ $mechanic->lastName }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idMechanic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="saleDate" class="form-label">Fecha de Venta *</label>
                            <input type="datetime-local" 
                                   class="form-control @error('saleDate') is-invalid @enderror" 
                                   id="saleDate" name="saleDate" 
                                   value="{{ old('saleDate', $sale->saleDate->format('Y-m-d\TH:i')) }}" 
                                   required>
                            @error('saleDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="total" class="form-label">Total *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" 
                                       step="0.01" 
                                       class="form-control @error('total') is-invalid @enderror" 
                                       id="total" name="total" 
                                       value="{{ old('total', $sale->total) }}" 
                                       required>
                                @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado *</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="1" {{ old('status', $sale->status) == 1 ? 'selected' : '' }}>Activa</option>
                        <option value="0" {{ old('status', $sale->status) == 0 ? 'selected' : '' }}>Inactiva</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Venta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
