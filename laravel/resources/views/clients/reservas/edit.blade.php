@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-edit me-2"></i>Editar Reserva #{{ $reservation->idReservation }}
                </h1>
                <p class="page-subtitle">Modifica los detalles de tu reserva existente</p>
            </div>
            <!-- CORRECCIÓN: Ruta correcta -->
            <a href="{{ route('cliente.reservas') }}" class="btn btn-secondary-custom">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Error:</strong> Por favor corrige los siguientes errores:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Formulario de Edición -->
    <div class="content-card">
        <div class="card-header-custom">
            <h3 class="card-title-custom">
                <i class="fas fa-calendar-alt me-2"></i>Información Actual de la Reserva
            </h3>
        </div>

    <!-- CORRECCIÓN: Ruta correcta -->
    <form action="{{ route('cliente.reservas.update', $reservation->idReservation) }}" method="POST" id="editReservaForm">
        @csrf
        @method('PUT')
        <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Motocicleta</label>
                    <div class="p-3 bg-light rounded">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-motorcycle fa-2x text-primary"></i>
                            </div>
                            <div class="col-9">
                                <h6 class="mb-1 fw-bold">{{ $reservation->motorcycle->brand }} {{ $reservation->motorcycle->model }}</h6>
                                <p class="mb-0 text-muted small">Placa: {{ $reservation->motorcycle->licensePlate }}</p>
                                <input type="hidden" name="idMotorcycle" value="{{ $reservation->idMotorcycle }}">
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">No puedes cambiar la motocicleta de una reserva existente</small>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Estado Actual</label>
                    <div class="p-3 bg-light rounded">
                        <span class="badge-custom 
                            @if($reservation->status == 1) badge-warning
                            @elseif($reservation->status == 2) badge-confirmed
                            @elseif($reservation->status == 3) badge-completed
                            @else badge-cancelled @endif">
                            {{ $reservation->status_text }}
                        </span>
                    </div>
                    <small class="text-muted">El estado será actualizado por el administrador</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Nueva Fecha <span class="text-danger">*</span></label>
                    <input type="date" name="reservationDate" class="form-control custom-input" 
                           value="{{ old('reservationDate', $reservation->reservationDate->format('Y-m-d')) }}" 
                           min="{{ date('Y-m-d') }}" required id="editReservationDate">
                    <small class="text-muted">Fecha original: {{ $reservation->reservationDate->format('d/m/Y') }}</small>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Nueva Hora <span class="text-danger">*</span></label>
                    <select name="reservationTime" class="form-select custom-select" required id="editReservationTime">
                        <option value="">Selecciona un horario</option>
                        @foreach($availableTimes as $time)
                            <option value="{{ $time }}" 
                                {{ old('reservationTime', $reservation->reservationTime) == $time ? 'selected' : '' }}>
                                {{ $time }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hora original: {{ $reservation->reservationTime }}</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Verificar Disponibilidad</label>
                    <button type="button" class="btn btn-outline-warning w-100" onclick="checkEditAvailability()" id="checkAvailabilityBtn">
                        <i class="fas fa-sync-alt me-1"></i> Verificar Disponibilidad
                    </button>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Estado de Disponibilidad</label>
                    <div id="editAvailabilityStatus" class="availability-status mt-2">
                        <div class="text-center">
                            <i class="fas fa-info-circle text-muted"></i>
                            <small class="text-muted">Haz clic en "Verificar Disponibilidad"</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <label class="form-label fw-bold">Notas del Servicio <span class="text-muted">(Opcional)</span></label>
                    <textarea name="notes" class="form-control custom-textarea" rows="4" 
                              placeholder="Modifica la descripción del servicio si es necesario...">{{ old('notes', $reservation->notes) }}</textarea>
                    <small class="text-muted">Actualiza la descripción si hay cambios en lo que necesitas</small>
                </div>
            </div>

            <!-- Resumen de Cambios -->
            <div class="row">
                <div class="col-12">
                    <div class="changes-summary p-4 bg-warning rounded">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>Resumen de Cambios
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <small class="text-dark">Fecha:</small>
                                <p class="mb-1">
                                    <span class="text-danger"><del>{{ $reservation->reservationDate->format('d/m/Y') }}</del></span>
                                    <br>
                                    <span class="text-success fw-bold" id="newDatePreview">-</span>
                                </p>
                            </div>
                            <div class="col-md-3">
                                <small class="text-dark">Hora:</small>
                                <p class="mb-1">
                                    <span class="text-danger"><del>{{ $reservation->reservationTime }}</del></span>
                                    <br>
                                    <span class="text-success fw-bold" id="newTimePreview">-</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-dark">Nota:</small>
                                <p class="mb-1 text-dark">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Los cambios estarán pendientes de confirmación
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('cliente.reservas') }}" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </a>
                        <div class="d-flex gap-2">
                            
                            <button type="submit" class="btn btn-warning-custom" id="editSubmitReservaBtn" disabled>
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<style>
.changes-summary {
    border-left: 4px solid #dc3545;
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%) !important;
}

.bg-warning {
    background: rgba(255, 193, 7, 0.1) !important;
}

.btn-danger-custom {
    background: #dc3545;
    border: 2px solid #dc3545;
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-danger-custom:hover {
    background: transparent;
    color: #dc3545;
    transform: translateY(-2px);
}

.btn-outline-warning {
    border: 2px solid var(--gold);
    color: var(--navy);
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-warning:hover {
    background: var(--gold);
    color: var(--navy);
    transform: translateY(-2px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editDate = document.getElementById('editReservationDate');
    const editTime = document.getElementById('editReservationTime');
    const availabilityStatus = document.getElementById('editAvailabilityStatus');
    const submitBtn = document.getElementById('editSubmitReservaBtn');
    const newDatePreview = document.getElementById('newDatePreview');
    const newTimePreview = document.getElementById('newTimePreview');

    // Actualizar previsualización de cambios
    editDate.addEventListener('change', function() {
        newDatePreview.textContent = this.value ? new Date(this.value).toLocaleDateString('es-ES') : '-';
    });

    editTime.addEventListener('change', function() {
        newTimePreview.textContent = this.value || '-';
    });

    // Verificar disponibilidad
    window.checkEditAvailability = function() {
        const date = editDate.value;
        const time = editTime.value;
        const motorcycle = '{{ $reservation->idMotorcycle }}';
        
        if (date && time) {
            availabilityStatus.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border spinner-border-sm text-warning me-2" role="status"></div>
                    <small class="availability-checking">Verificando disponibilidad...</small>
                </div>
            `;
            submitBtn.disabled = true;
            
            // Simular verificación (reemplazar con AJAX real)
            setTimeout(() => {
                const isAvailable = Math.random() > 0.3; // Simulación
                
                if (isAvailable) {
                    availabilityStatus.innerHTML = `
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small class="availability-available">¡Nuevo horario disponible!</small>
                        </div>
                    `;
                    submitBtn.disabled = false;
                } else {
                    availabilityStatus.innerHTML = `
                        <div class="text-center">
                            <i class="fas fa-times-circle text-danger me-2"></i>
                            <small class="availability-unavailable">Horario no disponible</small>
                        </div>
                    `;
                    submitBtn.disabled = true;
                }
            }, 1500);
        } else {
            alert('Por favor, selecciona una fecha y hora primero.');
        }
    }

    // Validación del formulario
    document.getElementById('editReservaForm').addEventListener('submit', function(e) {
        if (submitBtn.disabled) {
            e.preventDefault();
            alert('Por favor, verifica la disponibilidad antes de guardar los cambios.');
        }
    });
});
</script>
@endsection