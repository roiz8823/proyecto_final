@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold">Detalles de la Reserva #{{ $reservation->idReservation }}</h4>
            <div>
                <form action="{{ route('reservations.updateStatus', $reservation->idReservation) }}" method="POST" class="d-inline">
                    @csrf
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="0" {{ $reservation->status == 0 ? 'selected' : '' }}>Cancelada</option>
                        <option value="1" {{ $reservation->status == 1 ? 'selected' : '' }}>Pendiente</option>
                        <option value="2" {{ $reservation->status == 2 ? 'selected' : '' }}>Confirmada</option>
                        <option value="3" {{ $reservation->status == 3 ? 'selected' : '' }}>Completada</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Información de la Reserva</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">ID Reserva:</th>
                            <td>{{ $reservation->idReservation }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Reserva:</th>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservationDate)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Hora:</th>
                            <td>{{ $reservation->reservationTime }}</td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <span class="badge bg-{{ $reservation->status_class }}">
                                    {{ $reservation->status_text }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de Creación:</th>
                            <td>{{ \Carbon\Carbon::parse($reservation->creationDate)->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <h5>Información de la Motocicleta</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Marca/Modelo:</th>
                            <td>{{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}</td>
                        </tr>
                        <tr>
                            <th>Placa:</th>
                            <td>{{ $reservation->motorcycle->licensePlate }}</td>
                        </tr>
                        <tr>
                            <th>Propietario:</th>
                            <td>
                                {{ $reservation->motorcycle->user->firstName ?? 'N/A' }} 
                                {{ $reservation->motorcycle->user->lastName ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Contacto:</th>
                            <td>
                                {{ $reservation->motorcycle->user->email ?? 'N/A' }}
                                @if($reservation->motorcycle->user->phone)
                                    <br>{{ $reservation->motorcycle->user->phone }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            @if($reservation->notes)
            <div class="row mt-3">
                <div class="col-12">
                    <h5>Notas Adicionales</h5>
                    <div class="alert alert-info">
                        {{ $reservation->notes }}
                    </div>
                </div>
            </div>
            @endif
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('reservations.edit', $reservation->idReservation) }}" 
                       class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('reservations.destroy', $reservation->idReservation) }}" 
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection