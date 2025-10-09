@extends('clients.layouts.master')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-calendar-plus me-2"></i>Nueva Reserva
                </h1>
                <p class="page-subtitle">Agenda un nuevo mantenimiento para tu motocicleta</p>
            </div>
            <!-- CORRECCIÓN: Ruta correcta -->
            <a href="{{ route('cliente.reservas') }}" class="btn btn-secondary-custom">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>

    <!-- Formulario -->
    <div class="content-card">
        <div class="card-header-custom">
            <h3 class="card-title-custom">
                <i class="fas fa-motorcycle me-2"></i>Información de la Reserva
            </h3>
        </div>
        
        <!-- CORRECCIÓN: Ruta correcta -->
        <form action="{{ route('cliente.reservas.store') }}" method="POST" id="nuevaReservaForm">
            @csrf
             <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Selecciona tu Motocicleta <span class="text-danger">*</span></label>
                    <select name="idMotorcycle" class="form-select custom-select" required id="motorcycleSelect">
                        <option value="">Elige una motocicleta</option>
                        @foreach($motorcycles as $motorcycle)
                            <option value="{{ $motorcycle->idMotorcycle }}" 
                                    data-brand="{{ $motorcycle->brand }}"
                                    data-model="{{ $motorcycle->model }}"
                                    data-plate="{{ $motorcycle->licensePlate }}">
                                {{ $motorcycle->brand }} {{ $motorcycle->model }} ({{ $motorcycle->licensePlate }})
                            </option>
                        @endforeach
                    </select>
                    
                    <!-- Info de la motocicleta seleccionada -->
                    <div id="motorcycleInfo" class="mt-3 p-3 bg-light rounded d-none">
                        <div class="row">
                            <div class="col-4 text-center">
                                <i class="fas fa-motorcycle fa-2x text-primary"></i>
                            </div>
                            <div class="col-8">
                                <h6 id="selectedBrandModel" class="mb-1 fw-bold"></h6>
                                <p id="selectedPlate" class="mb-0 text-muted small"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Fecha del Servicio <span class="text-danger">*</span></label>
                    <input type="date" name="reservationDate" class="form-control custom-input" 
                           min="{{ date('Y-m-d') }}" required id="reservationDate">
                    <small class="text-muted">Selecciona una fecha futura para el servicio</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Hora del Servicio <span class="text-danger">*</span></label>
                    <select name="reservationTime" class="form-select custom-select" required id="reservationTime">
                        <option value="">Selecciona un horario</option>
                        @foreach($availableTimes as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Horarios disponibles de 8:00 AM a 6:00 PM</small>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label fw-bold">Estado de Disponibilidad</label>
                    <div id="availabilityStatus" class="availability-status mt-2">
                        <div class="text-center">
                            <i class="fas fa-info-circle text-muted"></i>
                            <small class="text-muted">Selecciona fecha y hora para ver disponibilidad</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <label class="form-label fw-bold">Descripción del Servicio <span class="text-muted">(Opcional)</span></label>
                    <textarea name="notes" class="form-control custom-textarea" rows="5" 
                              placeholder="Describe detalladamente el problema o servicio que necesitas...
                              
Ejemplos:
- Cambio de aceite y filtro
- Problema con los frenos
- Mantenimiento general
- Reparación de motor
- ..."></textarea>
                    <small class="text-muted">Una descripción detallada ayuda a nuestros mecánicos a prepararse mejor</small>
                </div>
            </div>

            <!-- Resumen de la Reserva -->
            <div class="row">
                <div class="col-12">
                    <div class="reservation-summary p-4 bg-light rounded">
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="fas fa-clipboard-check me-2"></i>Resumen de tu Reserva
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <small class="text-muted">Motocicleta:</small>
                                <p id="summaryMotorcycle" class="fw-bold mb-2">-</p>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Fecha:</small>
                                <p id="summaryDate" class="fw-bold mb-2">-</p>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Hora:</small>
                                <p id="summaryTime" class="fw-bold mb-2">-</p>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Estado:</small>
                                <p class="fw-bold mb-2"><span class="badge-custom badge-warning">Pendiente</span></p>
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
                        <button type="submit" class="btn btn-primary-custom" id="submitReservaBtn" disabled>
                            <i class="fas fa-calendar-check me-1"></i> Confirmar Reserva
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
.reservation-summary {
    border-left: 4px solid var(--gold);
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
}

.custom-select, .custom-input, .custom-textarea {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.custom-select:focus, .custom-input:focus, .custom-textarea:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 0.3rem rgba(249, 205, 22, 0.2);
    transform: translateY(-2px);
}

.availability-status {
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.bg-light-custom {
    background: rgba(248, 249, 250, 0.8) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const motorcycleSelect = document.getElementById('motorcycleSelect');
    const motorcycleInfo = document.getElementById('motorcycleInfo');
    const selectedBrandModel = document.getElementById('selectedBrandModel');
    const selectedPlate = document.getElementById('selectedPlate');
    const reservationDate = document.getElementById('reservationDate');
    const reservationTime = document.getElementById('reservationTime');
    const availabilityStatus = document.getElementById('availabilityStatus');
    const submitBtn = document.getElementById('submitReservaBtn');
    
    const summaryMotorcycle = document.getElementById('summaryMotorcycle');
    const summaryDate = document.getElementById('summaryDate');
    const summaryTime = document.getElementById('summaryTime');

    // Mostrar info de motocicleta seleccionada
    motorcycleSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (this.value) {
            motorcycleInfo.classList.remove('d-none');
            selectedBrandModel.textContent = `${selectedOption.dataset.brand} ${selectedOption.dataset.model}`;
            selectedPlate.textContent = `Placa: ${selectedOption.dataset.plate}`;
            summaryMotorcycle.textContent = `${selectedOption.dataset.brand} ${selectedOption.dataset.model}`;
        } else {
            motorcycleInfo.classList.add('d-none');
            summaryMotorcycle.textContent = '-';
        }
        checkAvailability();
    });

    // Actualizar resumen y verificar disponibilidad
    reservationDate.addEventListener('change', function() {
        summaryDate.textContent = this.value ? new Date(this.value).toLocaleDateString('es-ES') : '-';
        checkAvailability();
    });

    reservationTime.addEventListener('change', function() {
        summaryTime.textContent = this.value || '-';
        checkAvailability();
    });

    function checkAvailability() {
        const date = reservationDate.value;
        const time = reservationTime.value;
        const motorcycle = motorcycleSelect.value;
        
        if (date && time && motorcycle) {
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
                            <small class="availability-available">¡Horario disponible!</small>
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
            availabilityStatus.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-info-circle text-muted"></i>
                    <small class="text-muted">Selecciona fecha y hora para ver disponibilidad</small>
                </div>
            `;
            submitBtn.disabled = true;
        }
    }

    // Validación del formulario
    document.getElementById('nuevaReservaForm').addEventListener('submit', function(e) {
        if (submitBtn.disabled) {
            e.preventDefault();
            alert('Por favor, verifica la disponibilidad antes de confirmar la reserva.');
        }
    });
});
</script>
@endsection

