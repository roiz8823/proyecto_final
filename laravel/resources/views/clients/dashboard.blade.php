@extends('clients.layouts.master')

@section('content')
<div class="dashboard-main-content">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1 class="welcome-title">Bienvenido, {{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</h1>
        <p class="welcome-subtitle">Panel de control - Taller Izquierdo</p>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Fila 1: 2 cards arriba -->
        <div class="dashboard-row">
            <!-- Card 1: Reservas -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="card-title">Hacer Reserva</h3>
                </div>
                <a href="{{ route('cliente.reservas') }}" class="card-btn">Reservar Ahora</a>
            </div>

            <!-- Card 2: Historial -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="card-title">Historial de Mantenimiento</h3>
                </div>
                <a href="{{ route('cliente.mantenimiento.historial') }}" class="card-btn">Ver Historial</a>
            </div>
        </div>

        <!-- Fila 2: 2 cards abajo -->
        <div class="dashboard-row">
            <!-- Card 3: Motocicletas -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="card-title">Mis Motocicletas</h3>
                </div>
                <a href="{{ route('cliente.motocicletas') }}" class="card-btn">Ver Motos</a>
            </div>

            <!-- Card 4: Repuestos -->
            <div class="dashboard-card">
                <div>
                    <div class="card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3 class="card-title">Repuestos Disponibles</h3>
                </div>
                <a href="{{ route('cliente.repuestos') }}" class="card-btn">Ver Repuestos</a>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el dashboard que no hereden el margin-left */
.dashboard-main-content {
    width: 100%;
    padding: 0;
    margin: 0;
    min-height: calc(100vh - 76px);
}

.welcome-section {
    background: linear-gradient(135deg, var(--navy) 0%, #03274d 100%);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 8px 25px rgba(2, 23, 48, 0.3);
    border-left: 5px solid var(--gold);
}

.welcome-title {
    font-weight: 800;
    font-size: 2.2rem;
    margin-bottom: 5px;
    color: white;
}

.welcome-subtitle {
    color: var(--gold);
    font-weight: 600;
    font-size: 1.1rem;
    opacity: 0.9;
}

.dashboard-grid {
    display: flex;
    flex-direction: column;
    gap: 25px;
    margin-bottom: 40px;
}

.dashboard-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.dashboard-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border-top: 5px solid var(--gold);
    height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.card-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--navy), #03274d);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
    margin-bottom: 15px;
}

.card-title {
    font-size: 1.3em;
    margin-bottom: 10px;
    color: var(--navy);
    font-weight: 700;
}

.card-description {
    color: var(--slate);
    margin-bottom: 20px;
    line-height: 1.5;
    flex-grow: 1;
}

.card-btn {
    display: inline-block;
    background: var(--navy);
    color: white;
    padding: 12px 25px;
    border-radius: 8px;
    text-decoration: none;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid var(--navy);
}

.card-btn:hover {
    background: transparent;
    color: var(--navy);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .welcome-section {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .welcome-title {
        font-size: 1.8rem;
    }
    
    .dashboard-card {
        height: auto;
        min-height: 200px;
    }
}
</style>
@endsection