<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="{{ route('mechanic.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading fw-bold">Administrar</div>
            
            <a class="nav-link" href="{{ route('mechanic.clients.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                Clientes
            </a>
            <a class="nav-link" href="{{ route('mechanic.motorcycles.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-motorcycle"></i></div>
                Motocicletas
            </a>
            <a class="nav-link" href="{{ route('mechanic.maintenances.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                Mantenimientos
            </a>
            <a class="nav-link" href="{{ route('mechanic.reservations.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                Reservas
            </a>
            <a class="nav-link" href="{{ route('mechanic.store.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                Almacén
            </a>
            <a class="nav-link" href="{{ route('mechanic.sales.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                Ventas
            </a>
        </div>
    </div>
</nav>