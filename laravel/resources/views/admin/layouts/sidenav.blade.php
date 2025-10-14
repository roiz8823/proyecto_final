<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            @if(auth()->user()->role === 'admin')
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-home-alt"></i></div>
                                    Dashboard
                                </a>
                             @endif

                            <div class="sb-sidenav-menu-heading fw-bold">Administrar</div>
                            
                            @if(auth()->user()->role === 'admin')
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    Usuarios
                                </a>
                                <a class="nav-link" href="/clients">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                                    Clientes
                                </a>
                                <a class="nav-link" href="/mechanic">
                                    <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                                    Mecanicos
                                </a>
                                <a class="nav-link" href="{{ route('motorcycles.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-motorcycle"></i></div>
                                    Motocicletas
                                </a>
                                <a class="nav-link" href="/maintenances">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                    Mantenimientos
                                </a>
                                <a class="nav-link" href="{{ route('reservations.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                    Reservas
                                </a>
                                <a class="nav-link" href="{{ route('store.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                                    Almacen
                                </a>
                                <a class="nav-link" href="{{ route('sales.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                                    Ventas
                                </a>
                                <a class="nav-link" href="index.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                    Reportes
                                </a>
                            @endif
                        </div>
                    </div>
                </nav>