<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Iniciar sesión - Taller Izquierdo" />
        <meta name="author" content="Taller Izquierdo" />
        <title>Iniciar Sesión - Taller Izquierdo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <style>
            :root {
                --black: #000000;
                --gray: #838383;
                --slate: #58606D;
                --gold: #F9CD16;
                --navy: #021730;
            }
            
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, var(--navy) 0%, #03274d 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
            
            .login-container {
                background: white;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                position: relative;
            }
            
            .login-header {
                background: linear-gradient(to right, var(--navy), #03274d);
                color: white;
                padding: 30px;
                text-align: center;
                position: relative;
                overflow: hidden;
            }
            
            .login-header::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 100%;
                height: 200%;
                background: rgba(249, 205, 22, 0.1);
                transform: rotate(-15deg);
            }
            
            .logo {
                font-size: 2.5rem;
                font-weight: 800;
                margin-bottom: 10px;
                position: relative;
                z-index: 2;
            }
            
            .logo span {
                color: var(--gold);
            }
            
            .login-subtitle {
                color: var(--gold);
                font-weight: 600;
                margin-bottom: 0;
                position: relative;
                z-index: 2;
            }
            
            .login-body {
                padding: 40px;
            }
            
            .form-group {
                margin-bottom: 25px;
                position: relative;
            }
            
            .form-control {
                border: 2px solid #e9ecef;
                border-radius: 10px;
                padding: 15px 15px 15px 45px;
                height: auto;
                transition: all 0.3s;
                font-size: 1rem;
                width: 100%;
            }
            
            .form-control:focus {
                border-color: var(--gold);
                box-shadow: 0 0 0 0.25rem rgba(249, 205, 22, 0.25);
                outline: none;
            }
            
            .input-icon {
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--slate);
                font-size: 1.1rem;
                z-index: 3;
            }
            
            .form-label {
                position: absolute;
                left: 45px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--slate);
                transition: all 0.3s;
                pointer-events: none;
                background: white;
                padding: 0 5px;
                margin: 0;
            }
            
            .form-control:focus + .form-label,
            .form-control:not(:placeholder-shown) + .form-label {
                top: 0;
                font-size: 0.8rem;
                color: var(--navy);
                font-weight: 600;
            }
            
            .btn-login {
                background: linear-gradient(to right, var(--navy), #03274d);
                color: white;
                border: none;
                border-radius: 10px;
                padding: 15px 30px;
                font-weight: 700;
                font-size: 1.1rem;
                transition: all 0.3s;
                width: 100%;
                margin-top: 10px;
            }
            
            .btn-login:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(2, 23, 48, 0.4);
                background: linear-gradient(to right, #03274d, var(--navy));
            }
            
            .forgot-password {
                color: var(--slate);
                text-decoration: none;
                transition: color 0.3s;
                display: block;
                text-align: center;
                margin: 15px 0;
            }
            
            .forgot-password:hover {
                color: var(--navy);
            }
            
            .register-link {
                color: var(--navy);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s;
            }
            
            .register-link:hover {
                color: var(--gold);
            }
            
            .social-section {
                border-top: 1px solid #e9ecef;
                padding-top: 25px;
                margin-top: 25px;
            }
            
            .social-title {
                color: var(--slate);
                text-align: center;
                margin-bottom: 15px;
                font-size: 0.9rem;
            }
            
            .social-icons {
                display: flex;
                justify-content: center;
                gap: 15px;
            }
            
            .social-icon {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-decoration: none;
                transition: all 0.3s;
                font-size: 1.2rem;
            }
            
            .social-icon:hover {
                transform: translateY(-3px);
            }
            
            .facebook {
                background: #3b5998;
            }
            
            .instagram {
                background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
            }
            
            .whatsapp {
                background: #25D366;
            }
            
            .error-alert {
                background: rgba(220, 53, 69, 0.1);
                border: 1px solid rgba(220, 53, 69, 0.3);
                color: #dc3545;
                padding: 12px 15px;
                border-radius: 10px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 600;
            }
            
            .moto-icon {
                position: absolute;
                font-size: 8rem;
                opacity: 0.03;
                z-index: 1;
            }
            
            .moto-1 {
                top: 20%;
                left: 10%;
            }
            
            .moto-2 {
                bottom: 10%;
                right: 10%;
                transform: rotate(180deg);
            }
            
            .footer {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                color: white;
                margin-top: 30px;
                border-radius: 10px;
            }
            
            @media (max-width: 768px) {
                .login-container {
                    margin: 20px;
                }
                
                .login-body {
                    padding: 30px 25px;
                }
                
                .moto-icon {
                    font-size: 5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="login-container">
                        <!-- Iconos decorativos -->
                        <i class="fas fa-motorcycle moto-icon moto-1"></i>
                        <i class="fas fa-motorcycle moto-icon moto-2"></i>
                        
                        <!-- Encabezado -->
                        <div class="login-header">
                            <div class="logo">
                                <i class="fas fa-motorcycle"></i> Taller <span>Izquierdo</span>
                            </div>
                            <p class="login-subtitle">Especialistas en Motocicletas</p>
                        </div>
                        
                        <!-- Cuerpo del formulario -->
                        <div class="login-body">
                            @if ($errors->any())
                                <div class="error-alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            
                            <form method="POST" action="/login">
                                @csrf
                                
                                <!-- Campo Email -->
                                <div class="form-group">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input class="form-control" type="email" name="email" value="" placeholder=" " required />
                                    <label class="form-label">Email</label>
                                </div>
                                
                                <!-- Campo Contraseña -->
                                <div class="form-group">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input class="form-control" type="password" name="password" placeholder=" " required />
                                    <label class="form-label">Contraseña</label>
                                </div>
                                
                                <a href="#" class="forgot-password">
                                    <i class="fas fa-key me-1"></i>¿Olvidaste tu contraseña?
                                </a>
                                
                                <button class="btn btn-login" type="submit">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>
                            </form>
                            
                            <div class="text-center mt-3">
                                <span class="text-muted">¿Es tu primera vez? </span>
                                <a href="#" class="register-link">Regístrate aquí</a>
                            </div>
                            
                            <!-- Redes Sociales -->
                            <div class="social-section">
                                <div class="social-title">Síguenos en nuestras redes</div>
                                <div class="social-icons">
                                    <a href="#" class="social-icon facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="social-icon instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="social-icon whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <footer class="footer text-center py-3 mt-4">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-md-start">
                                    <small>&copy; 2024 Taller Izquierdo. Todos los derechos reservados.</small>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <small>
                                        <a href="#" class="text-white text-decoration-none me-3">Política de Privacidad</a>
                                        <a href="#" class="text-white text-decoration-none">Términos y Condiciones</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Efecto de labels flotantes
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('.form-control');
                
                inputs.forEach(input => {
                    // Verificar si ya tiene valor al cargar la página
                    if (input.value !== '') {
                        input.parentElement.querySelector('.form-label').classList.add('active');
                    }
                    
                    input.addEventListener('focus', function() {
                        this.parentElement.querySelector('.form-label').classList.add('active');
                    });
                    
                    input.addEventListener('blur', function() {
                        if (this.value === '') {
                            this.parentElement.querySelector('.form-label').classList.remove('active');
                        }
                    });
                });
            });
        </script>
    </body>
</html>