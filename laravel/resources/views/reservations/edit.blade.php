 
@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="fw-bold">Editar Reserva #{{ $reservation->idReservation }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('reservations.update', $reservation->idReservation) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select select2-search" name="idMotorcycle" id="idMotorcycle" required>
                                @foreach($motorcycles as $motorcycle)
                                    <option value="{{ $motorcycle->idMotorcycle }}" 
                                        {{ $reservation->idMotorcycle == $motorcycle->idMotorcycle ? 'selected' : '' }}>
                                        {{ $motorcycle->brand }} {{ $motorcycle->model }} 
                                        ({{ $motorcycle->licensePlate }}) - 
                                        {{ $motorcycle->user->firstName ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="idMotorcycle">Motocicleta</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="reservationDate" 
                                   name="reservationDate" value="{{ $reservation->reservationDate->format('Y-m-d') }}" required>
                            <label for="reservationDate">Fecha de Reserva</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="reservationTime" id="reservationTime" required>
                                @php
                                    $times = [
                                        '08:00', '09:00', '10:00', '11:00', 
                                        '12:00', '13:00', '14:00', '15:00', 
                                        '16:00', '17:00', '18:00'
                                    ];
                                @endphp
                                @foreach($times as $time)
                                    <option value="{{ $time }}" 
                                        {{ $reservation->reservationTime == $time ? 'selected' : '' }}>
                                        {{ $time }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="reservationTime">Hora</label>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="status" required>
                                <option value="0" {{ $reservation->status == 0 ? 'selected' : '' }}>Cancelada</option>
                                <option value="1" {{ $reservation->status == 1 ? 'selected' : '' }}>Pendiente</option>
                                <option value="2" {{ $reservation->status == 2 ? 'selected' : '' }}>Confirmada</option>
                                <option value="3" {{ $reservation->status == 3 ? 'selected' : '' }}>Completada</option>
                            </select>
                            <label for="status">Estado</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-floating mb-4">
                    <textarea class="form-control" id="notes" name="notes" 
                              style="height: 100px">{{ $reservation->notes }}</textarea>
                    <label for="notes">Notas Adicionales</label>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-search').select2({
            placeholder: "Buscar motocicleta...",
            allowClear: true
        });
    });
</script>
@endsection
@endsection