<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller Izquierdo - Especialistas en Motos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --black: #000000;
            --gray: #838383;
            --slate: #58606D;
            --gold: #F9CD16;
            --navy: #021730;
        }
        
        body {
            font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 80px;
            color: var(--black);
            background-color: #f8f9fa;
        }
        
        .navbar {
            background-color: var(--navy) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
            padding: 12px 0;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: white !important;
            letter-spacing: 0.5px;
        }
        
        .navbar-brand span {
            color: var(--gold);
        }
        
        .nav-link {
            font-weight: 600;
            color: rgba(255, 255, 255, 0.85) !important;
            transition: all 0.3s;
            padding: 0.5rem 1rem !important;
            border-radius: 4px;
            margin: 0 2px;
        }
        
        .nav-link:hover {
            color: var(--gold) !important;
            background-color: rgba(249, 205, 22, 0.1);
        }
        
        .btn-login {
            background-color: var(--gold);
            color: var(--navy);
            border: none;
            border-radius: 4px;
            padding: 8px 20px;
            font-weight: 700;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .hero-section {
            background: linear-gradient(rgba(2, 23, 48, 0.85), rgba(2, 23, 48, 0.9)), url('https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 140px 0 100px;
            text-align: center;
            position: relative;
        }
        
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom, transparent, #f8f9fa);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 45px;
            font-weight: 800;
            text-align: center;
            color: var(--navy);
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 5px;
            background: var(--gold);
            margin: 15px auto;
            border-radius: 2px;
        }
        
        .service-card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            background: white;
            border-top: 5px solid var(--gold);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .service-icon {
            font-size: 3.2rem;
            color: var(--navy);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        
        .service-card:hover .service-icon {
            transform: scale(1.1);
            color: var(--gold);
        }
        
        .service-card h5 {
            color: var(--navy);
            font-weight: 700;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .gallery-item:hover {
            border-color: var(--gold);
        }
        
        .gallery-item img {
            transition: transform 0.5s;
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, var(--navy), transparent);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            padding: 20px;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .cta-section {
            background: linear-gradient(to right, var(--navy), #03274d);
            color: white;
            padding: 70px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(249, 205, 22, 0.1);
            transform: rotate(-15deg);
            z-index: 1;
        }
        
        .feature-item {
            padding: 30px 25px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
            border-left: 4px solid var(--gold);
        }
        
        .feature-item:hover {
            transform: translateY(-5px);
        }
        
        .feature-item h5 {
            font-weight: 700;
            margin: 20px 0;
            color: var(--navy);
        }
        
        .feature-icon {
            font-size: 2.8rem;
            color: var(--navy);
            margin-bottom: 15px;
        }
        
        footer {
            background: var(--navy);
            color: white;
            padding: 60px 0 30px;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s;
        }
        
        .social-icons a:hover {
            color: var(--gold);
        }
        
        .btn-primary {
            background-color: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
            padding: 12px 30px;
            font-weight: 700;
            border-radius: 6px;
        }
        
        .btn-primary:hover {
            background-color: #e6b800;
            border-color: #e6b800;
            color: var(--navy);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249, 205, 22, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--navy);
            border-color: var(--navy);
            font-weight: 600;
            border-radius: 6px;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--navy);
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.25rem rgba(249, 205, 22, 0.25);
        }
        
        .form-floating>label {
            color: var(--gray);
        }
        
        .bg-light-custom {
            background-color: #f8f9fa;
        }
        
        .text-accent {
            color: var(--slate);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--gold);
            margin-bottom: 0;
        }
        
        .stats-label {
            color: var(--slate);
            font-weight: 600;
        }
        
        .gold-accent {
            color: var(--gold);
        }
        
        .navy-bg {
            background-color: var(--navy);
        }
        
        .testimonial-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-top: 4px solid var(--gold);
        }
        
        .testimonial-text {
            color: var(--slate);
            font-style: italic;
            position: relative;
            padding-left: 30px;
        }
        
        .testimonial-text::before {
            content: """;
            font-size: 4rem;
            color: var(--gold);
            position: absolute;
            left: 0;
            top: -20px;
            font-family: Arial, sans-serif;
        }
        
        .client-name {
            color: var(--navy);
            font-weight: 700;
            margin-top: 20px;
        }
        
        .client-role {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .brand-bar {
            background-color: var(--gold);
            padding: 15px 0;
            text-align: center;
        }
        
        .brand-bar h4 {
            color: var(--navy);
            font-weight: 700;
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-motorcycle me-2"></i>Taller <span>Izquierdo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeria">Galería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contáctenos</a>
                    </li>
                </ul>
                <a href="login" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section / Inicio -->
    <section id="inicio" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4 fw-bold mb-4">Expertos en Reparación y Mantenimiento de Motos</h1>
                    <p class="lead mb-4">Servicios de calidad con los mejores profesionales y repuestos garantizados</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Registrarse
                        </a>
                        <a href="#servicios" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">Nuestros Servicios</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Bar -->
    <div class="brand-bar">
        <div class="container">
            <h4><i class="fas fa-tools me-2"></i> Especialistas en todas las marcas de motocicletas <i class="fas fa-bolt ms-2"></i></h4>
        </div>
    </div>

    <!-- Nosotros Section -->
    <section id="nosotros" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="section-title">Sobre Nosotros</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-4">Más de 3 años de experiencia en el sector</h3>
                    <p class="lead text-accent">En Taller Izquierdo nos especializamos en ofrecer servicios de mantenimiento y reparación para todo tipo de motocicletas.</p>
                    <p>Nuestro equipo de mecánicos certificados garantiza que tu moto reciba el mejor cuidado posible, utilizando repuestos de calidad y las herramientas más modernas para diagnósticos precisos.</p>
                    <p>Nos enorgullece nuestro servicio al cliente y nuestra transparencia en cada trabajo que realizamos.</p>
                    <div class="d-flex mt-4 flex-wrap">
                        <div class="me-4 text-center mb-3">
                            <p class="stats-number">100+</p>
                            <p class="stats-label">Clientes Satisfechos</p>
                        </div>
                        <div class="me-4 text-center mb-3">
                            <p class="stats-number">3+</p>
                            <p class="stats-label">Años de Experiencia</p>
                        </div>
                        <div class="text-center mb-3">
                            <p class="stats-number">100%</p>
                            <p class="stats-label">Garantía en Servicios</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1609630875171-b1321377ee65?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Nuestro taller" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Section -->
    <section id="servicios" class="py-5">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <h5>Mantenimiento General</h5>
                            <p class="text-accent">Servicio completo de mantenimiento que incluye cambio de aceite, ajuste de frenos, revisión de suspensión y más para mantener tu moto en óptimas condiciones.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="fas fa-oil-can"></i>
                            </div>
                            <h5>Cambio de Aceite y Filtros</h5>
                            <p class="text-accent">Utilizamos los mejores aceites y filtros del mercado para garantizar el rendimiento y la vida útil del motor de tu motocicleta.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <h5>Reparación de Frenos</h5>
                            <p class="text-accent">Revisión completa del sistema de frenos, cambio de pastillas, líquido de frenos y ajuste para garantizar tu seguridad en la carretera.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="fas fa-battery-full"></i>
                            </div>
                            <h5>Servicio de Baterías</h5>
                            <p class="text-accent">Prueba, carga y reemplazo de baterías para evitar quedarte varado. Garantizamos baterías de alta calidad y duración.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="fas fa-tire"></i>
                            </div>
                            <h5>Cambio de Neumáticos</h5>
                            <p class="text-accent">Ofrecemos neumáticos de las mejores marcas con servicio de instalación profesional y balanceo preciso para mayor seguridad.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h5>Diagnóstico Computarizado</h5>
                            <p class="text-accent">Usamos tecnología de punta para diagnosticar problemas electrónicos y mecánicos con precisión, ahorrando tiempo y dinero.</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería Section -->
    <section id="galeria" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="section-title">Nuestro Trabajo</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="gallery-item">
                        <img src="https://www.shutterstock.com/image-photo/portrait-man-mechanic-garage-workshop-600nw-2185928805.jpg" alt="Cambio de aceite">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h5>Cambio de Aceite</h5>
                                <p class="mb-0">Servicio profesional</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1609630875171-b1321377ee65?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Reparación de motor">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h5>Reparación de Motor</h5>
                                <p class="mb-0">Mecánicos especializados</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="gallery-item">
                        <img src="https://www.mundomotero.com/wp-content/uploads/2016/08/Mantenimiento-del-sistema-de-frenos-de-una-moto.jpg" alt="Reparación de frenos">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h5>Sistema de Frenos</h5>
                                <p class="mb-0">Seguridad garantizada</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="gallery-item">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Lubricantes">
                        <div class="gallery-overlay">
                            <div class="text-white">
                                <h5>Productos de Calidad</h5>
                                <p class="mb-0">Lubricantes premium</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios Section -->
    <section id="testimonios" class="py-5">
        <div class="container">
            <h2 class="section-title">Lo que Dicen Nuestros Clientes</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">Excelente servicio, mi moto quedó como nueva. Muy profesionales y con precios justos. Definitivamente los recomiendo.</p>
                        <div class="client-name">Carlos Rodríguez</div>
                        <div class="client-role">Cliente hace 3 años</div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">Llevo mi moto al Taller Izquierdo desde hace 5 años. Nunca me han fallado y siempre me dan buenos consejos para el mantenimiento.</p>
                        <div class="client-name">María González</div>
                        <div class="client-role">Cliente frecuente</div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">Rápido, eficiente y con repuestos de calidad. Solucionaron un problema que tenía con mi moto en menos de un día.</p>
                        <div class="client-name">Javier López</div>
                        <div class="client-role">Nuevo cliente</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h3 class="mb-3">¿Necesitas ayuda urgente con tu moto?</h3>
                    <p class="lead mb-0">Contamos con servicio de grúa para asistencia en carretera las 24 horas</p>
                </div>
                <div class="col-lg-4">
                    <a href="#contacto" class="btn btn-warning btn-lg px-4 py-3 fw-bold">Contactar Emergencia</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto Section -->
    <section id="contacto" class="py-5">
        <div class="container">
            <h2 class="section-title">Contáctenos</h2>
            <div class="row">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body p-4">
                            <h4 class="mb-4 navy-bg" >Información de Contacto</h4>
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle p-3 me-3 navy-bg">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Dirección</h5>
                                    <p class="mb-0">1ro de Mayo Zona Sud</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle p-3 me-3 navy-bg">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Teléfono</h5>
                                    <p class="mb-0">+591 78796985</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle p-3 me-3 navy-bg">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Email</h5>
                                    <p class="mb-0">tall_izq@gmail.com</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle p-3 me-3 navy-bg">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Horario de Atención</h5>
                                    <p class="mb-0">Lunes a Sábado: 8:00 AM - 6:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
               
               
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Taller Izquierdo</h5>
                    <p>Expertos en reparación y mantenimiento de motocicletas con más de 3 años de experiencia en el mercado.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#inicio" class="text-white">Inicio</a></li>
                        <li class="mb-2"><a href="#servicios" class="text-white">Servicios</a></li>
                        <li><a href="#contacto" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="text-uppercase mb-4">Síguenos</h5>
                    <div class="social-icons mb-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <p class="mb-0">&copy; 2023 Taller Izquierdo. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>