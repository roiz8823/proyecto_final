@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="fw-bold">Editar Repuesto: {{ $store->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('store.update', $store->idPart) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ $store->name }}" required>
                            <label for="name">Nombre del Repuesto</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="category" name="category" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" 
                                        {{ $store->category == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category">Categoría</label>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" step="0.01" class="form-control" id="price" 
                                   name="price" value="{{ $store->price }}" required>
                            <label for="price">Precio Unitario ($)</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="stock" 
                                   name="stock" value="{{ $store->stock }}" min="0" required>
                            <label for="stock">Cantidad en Stock</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="status" required>
                                <option value="1" {{ $store->status == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $store->status == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <label for="status">Estado</label>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('store.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Repuesto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection