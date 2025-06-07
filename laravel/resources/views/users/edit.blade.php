@extends('admin.layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4 fw-bold">Editar usuario</h3></div>
                <div class="card-header">
                    @if ($errors->any())
                    <strong>Error:</strong> Corrige los siguientes campos:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card-body">

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="firstName" type="text" 
                                        placeholder="Nombre" value="{{ $user->firstName }}" required />
                                    <label >Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input class="form-control" name="lastName" type="text" 
                                        placeholder="Apellido Paterno" value="{{ $user->lastName }}" required />
                                    <label >Apellido Paterno</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input class="form-control" name="secondLastName" type="text" 
                                        placeholder="Apellido Materno" value="{{ $user->secondLastName }}" />
                                    <label >Apellido Materno</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" name="idNumber" type="text" 
                                        placeholder="Cédula/DNI" value="{{ $user->idNumber }}" required />
                                    <label >Cédula / DNI</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control"  name="phone" type="tel" 
                                        placeholder="Teléfono" value="{{ $user->phone }}" />
                                    <label >Teléfono</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" name="email" type="email" 
                                placeholder="Correo electronico" value="{{ $user->email }}" required />
                            <label >Correo electronico</label>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="role" required>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
                                        <option value="mechanic" {{ $user->role === 'mechanic' ? 'selected' : '' }}>Mecánico</option>
                                        <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Cliente</option>
                                    </select>
                                    <label >Rol</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="status">
                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                    <label >Estado</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" name="address" type="text" 
                                placeholder="Dirección" value="{{ $user->address }}" />
                            <label >Dirección</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="notes" 
                                    placeholder="Notas" style="height: 100px">{{ $user->notes }}</textarea>
                            <label >Notas</label>
                        </div>
                        
                        <div class="mt-4 mb-0">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('users.index') }}" class="btn btn-danger me-md-2">Cancelar</a>
                                <button class="btn btn-warning" type="submit">Actualizar Usuario</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




