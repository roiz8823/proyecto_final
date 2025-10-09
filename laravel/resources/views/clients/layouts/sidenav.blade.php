<!-- Sidebar -->
    <div class="sidebar">
        <ul class="sidebar-menu">
            @if(auth()->user()->role === 'client')
            <li class="sidebar-item">
                <a href="{{ route('cliente.dashboard') }}" class="sidebar-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('cliente.reservas') }}" class="sidebar-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>Mis Reservas</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('cliente.mantenimiento.historial') }}" class="sidebar-link">
                    <i class="fas fa-history"></i>
                    <span>Historial</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('cliente.motocicletas') }}" class="sidebar-link">
                    <i class="fas fa-motorcycle"></i>
                    <span>Mis Motos</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('cliente.repuestos') }}" class="sidebar-link">
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
            @endif
        </ul>
    </div>
