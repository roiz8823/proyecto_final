@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-users me-2"></i>Lista de Clientes
            </h1>
        </div>
    </div>

    <div class="card shadow border-0">
        <!-- Card Header con color -->
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle me-2 fs-5"></i>
                    <h5 class="mb-0 fw-bold">Clientes Registrados</h5>
                </div>
                <span class="badge bg-light text-primary fs-6">{{ $clients->count() }} clientes</span>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="bg-primary">Nro</th>
                            <th class="bg-primary">Nombre</th>
                            <th class="bg-primary">Correo</th>
                            <th class="bg-primary">Teléfono</th>
                            <th class="bg-primary text-center">Acción</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nro</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($clients as $key => $client)
                            <tr class="align-middle">
                                <td class="fw-bold text-primary">{{ $key + 1 }}</td>
                                <td>
                                    <strong class="text-dark">{{ $client->firstName }} {{ $client->lastName }}</strong>
                                    @if($client->secondLastName)
                                        <span class="text-muted">{{ $client->secondLastName }}</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-envelope text-muted me-1"></i>
                                    {{ $client->email }}
                                </td>
                                <td>
                                    <i class="fas fa-phone text-muted me-1"></i>
                                    {{ $client->phone }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mechanic.clients.show', $client->idUser) }}" 
                                       class="btn btn-info btn-sm shadow-sm" 
                                       title="Ver motocicletas del cliente">
                                        <i class="fas fa-motorcycle me-1"></i> Ver
                                    </a>
                                </td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection