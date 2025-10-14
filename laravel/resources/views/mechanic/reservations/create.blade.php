@extends('mechanic.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-plus-circle me-2"></i>Nueva Reserva
            </h1>
        </div>
        <a href="{{ route('mechanic.reservations.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-success text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-calendar-plus me-2"></i>Crear Nueva Reserva
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mechanic.reservations.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idMotorcycle" class="form-label fw-bold">Motocicleta *</label>
                            <select class="form-select @error('idMotorcycle') is-invalid @enderror" 
                                    id="idMotorcycle" name="idMotorcycle" required>
                                <option value="">Seleccionar Motocicleta</option>
                                @foreach($motorcycles as $motorcycle)
                                    <option value="{{ $motorcycle->idMotorcycle }}" 
                                        {{ old('idMotorcycle') == $motorcycle->idMotorcycle ? 'selected' : '' }}>
                                        {{ $motorcycle->brand }} {{ $motorcycle->model }} - 
                                        {{ $motorcycle->licensePlate }} 
                                        ({{ $motorcycle->user->firstName }} {{ $motorcycle->user->lastName }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idMotorcycle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reservationDate" class="form-label fw-bold">Fecha de Reserva *</label>
                            <input type="date" 
                                   class="form-control @error('reservationDate') is-invalid @enderror" 
                                   id="reservationDate" name="reservationDate" 
                                   value="{{ old('reservationDate', date('Y-m-d')) }}" 
                                   min="{{ date('Y-m-d') }}"
                                   required>
                            @error('reservationDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reservationTime" class="form-label fw-bold">Hora de Reserva *</label>
                            <select class="form-select @error('reservationTime') is-invalid @enderror" 
                                    id="reservationTime" name="reservationTime" required>
                                <option value="">Seleccionar Hora</option>
                                <option value="08:00" {{ old('reservationTime') == '08:00' ? 'selected' : '' }}>08:00 AM</option>
                                <option value="09:00" {{ old('reservationTime') == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                                <option value="10:00" {{ old('reservationTime') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                <option value="11:00" {{ old('reservationTime') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="12:00" {{ old('reservationTime') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                <option value="13:00" {{ old('reservationTime') == '13:00' ? 'selected' : '' }}>01:00 PM</option>
                                <option value="14:00" {{ old('reservationTime') == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                                <option value="15:00" {{ old('reservationTime') == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                                <option value="16:00" {{ old('reservationTime') == '16:00' ? 'selected' : '' }}>04:00 PM</option>
                                <option value="17:00" {{ old('reservationTime') == '17:00' ? 'selected' : '' }}>05:00 PM</option>
                                <option value="18:00" {{ old('reservationTime') == '18:00' ? 'selected' : '' }}>06:00 PM</option>
                            </select>
                            @error('reservationTime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Estado *</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Pendiente</option>
                                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Confirmada</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label fw-bold">Notas Adicionales</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" name="notes" 
                              rows="3" 
                              placeholder="Notas adicionales sobre la reserva...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <a href="{{ route('mechanic.reservations.index') }}" class="btn btn-secondary me-md-2">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Crear Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection