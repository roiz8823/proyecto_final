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
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: var(--navy) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 12px 0;
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
        
        /* Sidebar Styles */
        .sidebar {
            background-color: white;
            height: calc(100vh - 76px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 76px;
            left: 0;
            width: 250px;
            padding: 20px 0;
            z-index: 100;
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
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            margin-top: 76px;
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
        
        /* Responsive */
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
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-motorcycle me-2"></i>Taller <span>Izquierdo</span>
            </a>
            
            <div class="d-flex align-items-center">
                <div class="user-info me-3 text-end">
                    <div class="fw-bold">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</div>
                    <div class="user-role">Cliente</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>Mis Reservas</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-history"></i>
                    <span>Historial</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-motorcycle"></i>
                    <span>Mis Motos</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-cogs"></i>
                    <span>Repuestos</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-user-circle"></i>
                    <span>Mi Perfil</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-question-circle"></i>
                    <span>Ayuda</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Bienvenido, {{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h1>
            <p class="welcome-subtitle">Panel de control - Taller Izquierdo</p>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Card 1: Reservas -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="card-title">Hacer Reserva</h3>
                </div>
                <a href="#" class="card-btn">Reservar Ahora</a>
            </div>

            <!-- Card 2: Historial -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="card-title">Historial de Mantenimiento</h3>
                </div>
                <a href="#" class="card-btn">Ver Historial</a>
            </div>

            <!-- Card 3: Motocicletas -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="card-title">Mis Motocicletas</h3>
                </div>
                <a href="#" class="card-btn">Ver Motos</a>
            </div>

            <!-- Card 4: Repuestos -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3 class="card-title">Repuestos Disponibles</h3>
                </div>
                <a href="" class="card-btn">Ver Repuestos</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>