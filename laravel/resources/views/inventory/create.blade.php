 @extends('admin.layouts.master')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center font-weight-light my-4">
                            <i class="fas fa-box me-2"></i> Registrar Nuevo Repuesto
                        </h3>
                    </div>
                    
                    @if ($errors->any())
                    <div class="alert alert-danger mx-3 mt-3">
                        <strong><i class="fas fa-exclamation-circle me-2"></i>Error:</strong> Corrige los siguientes campos:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <div class="card-body">
                        <form action="{{ route('inventory.store') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="name" type="text" 
                                               placeholder="Nombre" value="{{ old('name') }}" required />
                                        <label for="name">Nombre del Repuesto</label>
                                    </div>
                                    <small class="text-muted">Ej: Filtro de aire, Pastillas de freno</small>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="idPart" type="text" 
                                               placeholder="Código" value="{{ old('idPart') }}" required />
                                        <label for="idPart">Código/N° Parte</label>
                                    </div>
                                    <small class="text-muted">Identificador único del repuesto</small>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="description" id="description" 
                                          style="height: 100px" required>{{ old('description') }}</textarea>
                                <label for="description">Descripción</label>
                                <small class="text-muted">Detalles técnicos o especificaciones</small>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-select" name="category" required>
                                            <option value="">Seleccione...</option>
                                            <option value="Motor" {{ old('category') == 'Motor' ? 'selected' : '' }}>Motor</option>
                                            <option value="Frenos" {{ old('category') == 'Frenos' ? 'selected' : '' }}>Frenos</option>
                                            <option value="Suspensión" {{ old('category') == 'Suspensión' ? 'selected' : '' }}>Suspensión</option>
                                            <option value="Eléctrico" {{ old('category') == 'Eléctrico' ? 'selected' : '' }}>Eléctrico</option>
                                            <option value="Transmisión" {{ old('category') == 'Transmisión' ? 'selected' : '' }}>Transmisión</option>
                                            <option value="Accesorios" {{ old('category') == 'Accesorios' ? 'selected' : '' }}>Accesorios</option>
                                        </select>
                                        <label for="category">Categoría</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" name="stock" type="number" 
                                               min="0" step="1" placeholder="Stock" 
                                               value="{{ old('stock', 0) }}" required />
                                        <label for="stock">Stock</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" name="price" type="number" 
                                               min="0" step="0.01" placeholder="Precio" 
                                               value="{{ old('price') }}" required />
                                        <label for="price">Precio (Bs)</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-select" name="status" required>
                                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Disponible</option>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Agotado</option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>En Pedido</option>
                                        </select>
                                        <label for="status">Estado</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="registrationDate" type="date" 
                                               value="{{ old('registrationDate', date('Y-m-d')) }}" required />
                                        <label for="registrationDate">Fecha de Registro</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('inventory.index') }}" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times me-1"></i> Cancelar
                                </a>
                                <button class="btn btn-success" type="submit">
                                    <i class="fas fa-save me-1"></i> Registrar Repuesto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection