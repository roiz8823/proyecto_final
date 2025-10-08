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