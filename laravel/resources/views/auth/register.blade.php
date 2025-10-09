<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registro - Taller Izquierdo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --navy: #021730;
            --gold: #F9CD16;
            --slate: #58606D;
            --gray: #838383;
        }
        
        body {
            background: linear-gradient(135deg, var(--navy) 0%, #03274d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        
        .register-header {
            background: var(--navy);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .register-body {
            padding: 2rem;
        }
        
        .btn-gold {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
            font-weight: 600;
            padding: 12px;
        }
        
        .btn-gold:hover {
            background: transparent;
            color: var(--gold);
            border-color: var(--gold);
        }
        
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(249, 205, 22, 0.25);
        }
        
        .login-link {
            color: var(--navy);
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link:hover {
            color: var(--gold);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="register-card">
                    <div class="register-header">
                        <h2><i class="fas fa-motorcycle me-2"></i>Taller Izquierdo</h2>
                        <p class="mb-0">Registro de Nuevo Cliente</p>
                    </div>
                    
                    <div class="register-body">
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

                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('firstName') is-invalid @enderror" 
                                               name="firstName" 
                                               type="text" 
                                               placeholder="Nombres" 
                                               value="{{ old('firstName') }}" 
                                               required />
                                        <label>Nombres</label>
                                        @error('firstName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('lastName') is-invalid @enderror" 
                                               name="lastName" 
                                               type="text" 
                                               placeholder="Apellidos" 
                                               value="{{ old('lastName') }}" 
                                               required />
                                        <label>Apellidos</label>
                                        @error('lastName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       type="email" 
                                       placeholder="Correo electrónico" 
                                       value="{{ old('email') }}" 
                                       required />
                                <label>Correo electrónico</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control @error('password') is-invalid @enderror" 
                                               name="password" 
                                               type="password" 
                                               placeholder="Contraseña" 
                                               required />
                                        <label>Contraseña</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" 
                                               name="password_confirmation" 
                                               type="password" 
                                               placeholder="Confirmar Contraseña" 
                                               required />
                                        <label>Confirmar Contraseña</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" 
                                       name="phone" 
                                       type="tel" 
                                       placeholder="Teléfono" 
                                       value="{{ old('phone') }}" />
                                <label>Teléfono</label>
                            </div>
                            
                            <div class="form-floating mb-4">
                                <input class="form-control" 
                                       name="address" 
                                       type="text" 
                                       placeholder="Dirección" 
                                       value="{{ old('address') }}" />
                                <label>Dirección</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-gold btn-lg py-3" type="submit">
                                    <i class="fas fa-user-plus me-2"></i>Registrarse
                                </button>
                            </div>

                            <div class="text-center">
                                <p>¿Ya tienes una cuenta? 
                                    <a href="{{ route('login') }}" class="login-link">
                                        <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>