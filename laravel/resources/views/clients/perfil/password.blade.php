@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-lock me-2"></i>Cambiar Contraseña
                </h1>
                <p class="page-subtitle">Actualiza tu contraseña de acceso</p>
            </div>
            <a href="{{ route('cliente.perfil') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver al Perfil
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-key me-2"></i>Seguridad de la Cuenta
                    </h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('cliente.password.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-bold">Contraseña Actual</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" 
                                   placeholder="Ingresa tu contraseña actual" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Debes ingresar tu contraseña actual para poder cambiarla.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label fw-bold">Nueva Contraseña</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" name="new_password" 
                                   placeholder="Ingresa tu nueva contraseña" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-shield-alt me-1"></i>
                                La contraseña debe tener al menos 6 caracteres.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label fw-bold">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" 
                                   id="new_password_confirmation" name="new_password_confirmation" 
                                   placeholder="Confirma tu nueva contraseña" required>
                            <div class="form-text">
                                <i class="fas fa-check-circle me-1"></i>
                                Ambos campos de contraseña deben coincidir.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg py-3">
                                <i class="fas fa-key me-1"></i> Actualizar Contraseña
                            </button>
                            <a href="{{ route('cliente.perfil') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Información de seguridad -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Consejos de Seguridad
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Usa una combinación de letras, números y símbolos
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Evita usar información personal fácil de adivinar
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            No reutilices contraseñas de otras cuentas
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success me-2"></i>
                            Cambia tu contraseña regularmente
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-radius: 12px;
}

.card-header {
    border-bottom: 2px solid rgba(0,0,0,0.1);
    border-radius: 12px 12px 0 0 !important;
}

.btn-warning {
    background-color: #F9CD16;
    border-color: #F9CD16;
    color: #000000;
    font-weight: 600;
}

.btn-warning:hover {
    background-color: #e6b800;
    border-color: #e6b800;
    color: #000000;
}

.form-control:focus {
    border-color: #F9CD16;
    box-shadow: 0 0 0 0.2rem rgba(249, 205, 22, 0.25);
}

.form-text {
    font-size: 0.85rem;
    color: #6c757d;
}

.page-header {
    background: linear-gradient(135deg, #021730 0%, #03274d 100%);
    color: white;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.page-title {
    color: #F9CD16;
}
</style>
@endsection