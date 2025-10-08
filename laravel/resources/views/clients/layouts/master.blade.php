<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente - Taller Izquierdo</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: var(--black);
            padding-top: 76px; /* Agregado para compensar navbar fija */
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: var(--navy) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 12px 0;
            position: fixed; /* Cambiado a fixed */
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 76px;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand span {
            color: var(--gold);
        }
        
        .user-info {
            color: white;
            font-weight: 600;
        }
        
        .user-role {
            color: var(--gold);
            font-size: 0.9rem;
        }
        
        .btn-logout {
            background-color: var(--gold);
            color: var(--navy);
            border: none;
            border-radius: 4px;
            padding: 6px 15px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-logout:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
        }
        
        /* Sidebar Styles - CORREGIDO */
        .sidebar {
            background-color: white;
            height: calc(100vh - 76px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 76px;
            left: 0;
            width: 250px;
            padding: 20px 0;
            z-index: 1020;
            overflow-y: auto;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-item {
            padding: 0;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--slate);
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .sidebar-link:hover, .sidebar-link.active {
            background-color: rgba(249, 205, 22, 0.1);
            color: var(--navy);
            border-left: 4px solid var(--gold);
        }
        
        .sidebar-link i {
            width: 25px;
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        /* Main Content - CORREGIDO */
        .main-content {
            margin-left: 250px; /* Mantiene el espacio para el sidebar */
            padding: 30px;
            min-height: calc(100vh - 76px);
            width: calc(100% - 250px); /* Asegura que no se superponga */
            position: relative;
            z-index: 1;
        }
        
        .welcome-section {
            background: linear-gradient(to right, var(--navy), #03274d);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-title {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .welcome-subtitle {
            color: var(--gold);
            font-weight: 600;
        }
        
        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-top: 20px;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            border-top: 5px solid var(--gold);
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .card-icon {
            font-size: 2.5rem;
            color: var(--navy);
            margin-bottom: 15px;
        }
        
        .card-title {
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 10px;
        }
        
        .card-description {
            color: var(--slate);
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .card-btn {
            background-color: var(--navy);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 15px;
            font-weight: 600;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        
        .card-btn:hover {
            background-color: var(--gold);
            color: var(--navy);
        }
        
        /* Responsive - CORREGIDO */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar-link span {
                display: none;
            }
            
            .sidebar-link i {
                margin-right: 0;
                font-size: 1.3rem;
            }
            
            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 0;
                overflow: hidden;
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px 15px;
            }
            
            /* Botón para mostrar/ocultar sidebar en móvil */
            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 85px;
                left: 15px;
                z-index: 1040;
                background: var(--gold);
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                color: var(--navy);
            }
            
            .sidebar.mobile-open {
                width: 250px;
                transform: translateX(0);
            }
        }
                /* ===== ESTILOS PARA LAS PÁGINAS DEL CLIENTE ===== */
        
        /* Estilos generales para todas las páginas */
        .page-header {
            background: linear-gradient(135deg, var(--navy) 0%, #03274d 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(2, 23, 48, 0.2);
            border-left: 5px solid var(--gold);
        }
        
        .page-title {
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 2rem;
        }
        
        .page-subtitle {
            color: var(--gold);
            font-weight: 600;
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Cards mejoradas */
        .content-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--gold);
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }
        
        .content-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .card-header-custom {
            background: transparent;
            border-bottom: 2px solid rgba(249, 205, 22, 0.2);
            padding: 0 0 15px 0;
            margin-bottom: 20px;
        }
        
        .card-title-custom {
            color: var(--navy);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }
        
        /* Botones personalizados */
        .btn-primary-custom {
            background: var(--navy);
            border: 2px solid var(--navy);
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background: transparent;
            color: var(--navy);
            transform: translateY(-2px);
        }
        
        .btn-warning-custom {
            background: var(--gold);
            border: 2px solid var(--gold);
            color: var(--navy);
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-warning-custom:hover {
            background: transparent;
            color: var(--navy);
            transform: translateY(-2px);
        }
        
        /* Badges personalizados */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .badge-pending {
            background: rgba(255, 193, 7, 0.15);
            color: #856404;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }
        
        .badge-confirmed {
            background: rgba(40, 167, 69, 0.15);
            color: #155724;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        .badge-completed {
            background: rgba(23, 162, 184, 0.15);
            color: #0c5460;
            border: 1px solid rgba(23, 162, 184, 0.3);
        }
        
        .badge-cancelled {
            background: rgba(220, 53, 69, 0.15);
            color: #721c24;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        /* Tablas personalizadas */
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        
        .table-custom thead {
            background: var(--navy);
            color: white;
        }
        
        .table-custom thead th {
            border: none;
            padding: 15px 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .table-custom tbody td {
            padding: 12px;
            border-color: rgba(0, 0, 0, 0.05);
            vertical-align: middle;
        }
        
        .table-custom tbody tr:hover {
            background: rgba(249, 205, 22, 0.05);
        }
        
        /* Filtros y búsqueda */
        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--gold);
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box .form-control {
            padding-left: 45px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .search-box .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(249, 205, 22, 0.25);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate);
        }
        
        /* Grid de items */
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .item-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--gold);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .item-card-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .item-card-title {
            font-weight: 700;
            color: var(--navy);
            margin: 0;
            font-size: 1.1rem;
        }
        
        .item-card-icon {
            width: 50px;
            height: 50px;
            background: rgba(249, 205, 22, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            font-size: 1.5rem;
        }
        
        /* Estadísticas */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-top: 4px solid var(--gold);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--slate);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        /* Modal personalizado */
        .modal-custom .modal-header {
            background: var(--navy);
            color: white;
            border-bottom: 3px solid var(--gold);
        }
        
        .modal-custom .modal-title {
            font-weight: 700;
        }
        
        .modal-custom .btn-close {
            filter: invert(1);
        }
        
        /* Alertas personalizadas */
        .alert-custom {
            border-radius: 10px;
            border: none;
            border-left: 4px solid;
            padding: 15px 20px;
        }
        
        .alert-info-custom {
            background: rgba(23, 162, 184, 0.1);
            border-left-color: var(--navy);
            color: var(--navy);
        }
        
        .alert-warning-custom {
            background: rgba(249, 205, 22, 0.1);
            border-left-color: var(--gold);
            color: #856404;
        }
        
        /* Paginación */
        .pagination-custom .page-link {
            color: var(--navy);
            border: 1px solid #dee2e6;
            padding: 8px 16px;
            margin: 0 3px;
            border-radius: 6px;
            font-weight: 600;
        }
        
        .pagination-custom .page-item.active .page-link {
            background: var(--navy);
            border-color: var(--navy);
            color: white;
        }
        
        .pagination-custom .page-link:hover {
            background: var(--gold);
            border-color: var(--gold);
            color: var(--navy);
        }
        
        /* Empty states */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--slate);
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: var(--gray);
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        .empty-state-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--slate);
        }
        
        .empty-state-text {
            color: var(--gray);
            margin-bottom: 25px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                margin-bottom: 20px;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .items-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            .content-card {
                padding: 20px;
            }
        }
                /* Clases adicionales para las páginas */
        .badge-info {
            background: rgba(23, 162, 184, 0.15);
            color: #0c5460;
            border: 1px solid rgba(23, 162, 184, 0.3);
        }
        
        .badge-warning {
            background: rgba(255, 193, 7, 0.15);
            color: #856404;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }
        
        .badge-danger {
            background: rgba(220, 53, 69, 0.15);
            color: #721c24;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .bg-light {
            background-color: rgba(248, 249, 250, 0.7) !important;
        }
        
        .border-warning {
            border: 2px solid rgba(255, 193, 7, 0.3) !important;
        }
        
        .text-primary {
            color: var(--navy) !important;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }
        
        .btn-outline-secondary {
            border-color: var(--slate);
            color: var(--slate);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--slate);
            border-color: var(--slate);
            color: white;
        }
    </style>
</head>
<body>
    @include('clients.layouts.navbar')
    <!-- Navbar -->
    @include('clients.layouts.Sidenav')
    <!-- Sidebar -->

    <!-- Botón toggle para móvil (opcional) -->
    <button class="sidebar-toggle d-md-none" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar en móvil
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('mobile-open');
        });

        // Cerrar sidebar al hacer clic fuera en móvil
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            
            if (window.innerWidth < 768 && 
                !sidebar.contains(event.target) && 
                !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
            }
        });
    </script>
</body>
</html>