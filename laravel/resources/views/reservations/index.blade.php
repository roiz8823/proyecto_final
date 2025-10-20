@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 fw-bold">Gestión de Reservas</h2>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-calendar-alt me-1"></i>
                <b>Reservas Registradas</b>
            </div>
            <a href="{{ route('reservations.create') }}" class="btn btn-success btn-sm fw-bold">
                <i class="fas fa-plus"></i> Nueva Reserva
            </a>
        </div>
        
        <div class="card-header">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        
        <div class="card-body">
            <table id="datatablesReservations" class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nro</th>
                        <th>Motocicleta</th>
                        <th>Propietario</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $key => $reservation)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <strong>{{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}</strong>
                            <br>
                            <small class="text-muted">{{ $reservation->motorcycle->licensePlate }}</small>
                        </td>
                        <td>
                            {{ $reservation->motorcycle->user->firstName ?? 'N/A' }} 
                            {{ $reservation->motorcycle->user->lastName ?? '' }}
                        </td>
                        <td>{{ $reservation->reservationDate->format('d/m/Y') }}</td>
                        <td>{{ $reservation->reservationTime }}</td>
                        <td>
                            <span class="badge bg-{{ $reservation->status_class }}">
                                {{ $reservation->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('reservations.show', $reservation->idReservation) }}" 
                                   class="btn btn-primary btn-sm" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('reservations.edit', $reservation->idReservation) }}" 
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('reservations.destroy', $reservation->idReservation) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            title="Eliminar"
                                            onclick="return confirm('¿Confirmas eliminar esta reserva?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($reservations->isEmpty())
                <div class="alert alert-info text-center">
                    No se encontraron reservas registradas
                </div>
            @endif
            
            <div class="d-flex justify-content-center mt-3">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#datatablesReservations').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            },
            dom: '<"top"f>rt<"bottom"lip><"clear">',
            pageLength: 10,
            order: [[3, 'desc'], [4, 'desc']] // Ordenar por fecha y hora descendente
        });
    });
</script>
@endsection
@endsection