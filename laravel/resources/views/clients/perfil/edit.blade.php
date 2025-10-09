@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header-custom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title-custom">
                    <i class="fas fa-user-edit me-2"></i>Editar Perfil
                </h1>
                <p class="page-subtitle-custom">Actualiza tu información personal y gestiona tu seguridad</p>
            </div>
            <a href="{{ route('cliente.perfil') }}" class="btn btn-back-custom">
                <i class="fas fa-arrow-left me-1"></i> Volver al Perfil
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Información Personal -->
        <div class="col-lg-8">
            <div class="card-custom card-edit">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <div class="card-icon-custom">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div>
                            <h5 class="card-title-custom">Información Personal</h5>
                            <p class="card-subtitle-custom">Actualiza tus datos de contacto</p>
                        </div>
                    </div>
                </div>
                <div class="card-body-custom">
                    @if(session('success'))
                        <div class="alert-custom alert-success-custom">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close-custom" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert-custom alert-danger-custom">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close-custom" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('cliente.perfil.update') }}" method="POST" class="form-custom">
                        @csrf
                        
                        <div class="row form-row-custom">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <div class="floating-label-group">
                                        <input class="form-input-custom @error('firstName') error-input @enderror" 
                                               name="firstName" 
                                               type="text" 
                                               value="{{ old('firstName', $user->firstName) }}" 
                                               required />
                                        <label class="floating-label text-black">Nombres</label>
                                        <i class="form-icon fas fa-user"></i>
                                    </div>
                                    @error('firstName')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <div class="floating-label-group">
                                        <input class="form-input-custom @error('lastName') error-input @enderror" 
                                               name="lastName" 
                                               type="text" 
                                               value="{{ old('lastName', $user->lastName) }}" 
                                               required />
                                        <label class="floating-label text-black">Apellidos</label>
                                        <i class="form-icon fas fa-user"></i>
                                    </div>
                                    @error('lastName')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <div class="floating-label-group">
                                <input class="form-input-custom @error('email') error-input @enderror" 
                                       name="email" 
                                       type="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required />
                                <label class="floating-label text-black">Correo electrónico</label>
                                <i class="form-icon fas fa-envelope"></i>
                            </div>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-custom">
                            <div class="floating-label-group">
                                <input class="form-input-custom" 
                                       name="phone" 
                                       type="tel" 
                                       value="{{ old('phone', $user->phone) }}" />
                                <label class="floating-label text-black">Teléfono</label>
                                <i class="form-icon fas fa-phone"></i>
                            </div>
                        </div>
                        
                        <div class="form-group-custom">
                            <div class="floating-label-group">
                                <input class="form-input-custom" 
                                       name="address" 
                                       type="text" 
                                       value="{{ old('address', $user->address) }}" />
                                <label class="floating-label text-black">Dirección</label>
                                <i class="form-icon fas fa-map-marker-alt"></i>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save-custom">
                                <i class="fas fa-save me-2"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Panel de Seguridad -->
        <div class="col-lg-4">
            <div class="card-custom card-security">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <div class="card-icon-custom security">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h5 class="card-title-custom">Seguridad</h5>
                            <p class="card-subtitle-custom">Protege tu cuenta</p>
                        </div>
                    </div>
                </div>
                <div class="card-body-custom text-center">
                    <div class="security-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h6 class="security-title">Contraseña</h6>
                    <p class="security-description">Actualiza regularmente tu contraseña para mantener tu cuenta segura</p>
                    <a href="{{ route('cliente.password.edit') }}" class="btn-security-custom">
                        <i class="fas fa-key me-2"></i> Cambiar Contraseña
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #021730;
    --secondary: #58606D;
    --accent: #F9CD16;
    --light: #838383;
    --dark: #000000;
    --success: #28a745;
    --danger: #dc3545;
    --warning: #ffc107;
    --info: #17a2b8;
}

/* Header Styles */
.page-header-custom {
    background: linear-gradient(135deg, var(--primary) 0%, #03274d 100%);
    color: white;
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(2, 23, 48, 0.3);
}

.page-title-custom {
    font-weight: 800;
    font-size: 2.2rem;
    margin-bottom: 0.5rem;
    color: var(--accent);
}

.page-subtitle-custom {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    margin-bottom: 0;
}

.btn-back-custom {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-weight: 600;
    padding: 12px 24px;
    border-radius: 10px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-back-custom:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: var(--dark);
    transform: translateY(-2px);
}

/* Card Styles */
.card-custom {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.card-header-custom {
    background: linear-gradient(135deg, var(--secondary), var(--primary));
    color: white;
    padding: 1.5rem;
    border-bottom: 2px solid var(--accent);
}

.card-security .card-header-custom {
    background: linear-gradient(135deg, var(--warning), #e6b800);
    color: var(--dark);
}

.card-info .card-header-custom {
    background: linear-gradient(135deg, var(--info), #138496);
}

.card-icon-custom {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.25rem;
}

.card-icon-custom.security {
    background: rgba(0, 0, 0, 0.1);
}

.card-icon-custom.info {
    background: rgba(255, 255, 255, 0.3);
}

.card-title-custom {
    font-weight: 700;
    margin-bottom: 0.25rem;
    font-size: 1.25rem;
}

.card-subtitle-custom {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.card-body-custom {
    padding: 2rem;
}

/* Form Styles */
.form-custom {
    max-width: 100%;
}

.form-row-custom {
    margin-bottom: 1.5rem;
}

.form-group-custom {
    margin-bottom: 1.5rem;
    position: relative;
}

.floating-label-group {
    position: relative;
}

.form-input-custom {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-input-custom:focus {
    border-color: var(--accent);
    background: white;
    box-shadow: 0 0 0 3px rgba(249, 205, 22, 0.1);
    outline: none;
}

.form-input-custom.error-input {
    border-color: var(--danger);
}

.floating-label {
    position: absolute;
    left: 3rem;
    top: 1rem;
    color: var(--light);
    transition: all 0.3s ease;
    pointer-events: none;
    background: transparent;
    padding: 0 0.25rem;
}

.form-input-custom:focus + .floating-label,
.form-input-custom:not(:placeholder-shown) + .floating-label {
    top: -0.5rem;
    left: 1rem;
    font-size: 0.8rem;
    color: var(--accent);
    background: white;
}

.form-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--light);
    transition: color 0.3s ease;
}

.form-input-custom:focus ~ .form-icon {
    color: var(--accent);
}

.error-message {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
}

.error-message::before {
    content: "⚠";
    margin-right: 0.5rem;
}

/* Button Styles */
.btn-save-custom {
    background: linear-gradient(135deg, var(--accent), #e6b800);
    border: none;
    color: var(--dark);
    font-weight: 700;
    padding: 1rem 2rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    width: 100%;
    font-size: 1.1rem;
}

.btn-save-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(249, 205, 22, 0.4);
}

/* Security Section */
.security-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--warning), #e6b800);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: var(--dark);
}

.security-title {
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--secondary);
}

.security-description {
    color: var(--light);
    margin-bottom: 2rem;
    line-height: 1.5;
}

.btn-security-custom {
    display: inline-block;
    background: var(--warning);
    color: var(--dark);
    padding: 12px 24px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid var(--warning);
    width: 100%;
}

.btn-security-custom:hover {
    background: transparent;
    color: var(--warning);
    transform: translateY(-2px);
}

/* Account Info */
.account-info {
    space-y: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: var(--secondary);
}

.info-value {
    color: var(--dark);
    font-weight: 500;
}

.badge-role {
    background: var(--accent);
    color: var(--dark);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-status.active {
    background: var(--success);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-status.inactive {
    background: var(--danger);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Alert Styles */
.alert-custom {
    padding: 1rem 1.5rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-left: 4px solid;
}

.alert-success-custom {
    background: #d1edff;
    color: #0c5460;
    border-left-color: var(--success);
}

.alert-danger-custom {
    background: #f8d7da;
    color: #721c24;
    border-left-color: var(--danger);
}

.btn-close-custom {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.btn-close-custom:hover {
    opacity: 1;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header-custom {
        padding: 1.5rem;
    }
    
    .page-title-custom {
        font-size: 1.8rem;
    }
    
    .card-body-custom {
        padding: 1.5rem;
    }
    
    .form-input-custom {
        padding: 0.875rem 0.875rem 0.875rem 2.5rem;
    }
    
    .security-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>
@endsection