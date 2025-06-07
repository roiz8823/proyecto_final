@extends('admin.layouts.master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4 fw-bold">Crear usuario</h3></div>
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
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="firstName" type="text" placeholder="Nombre" required />
                                        <label >Nombre</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control"  name="lastName" type="text" placeholder="Primer Apellido" required />
                                        <label >Primer Apellido</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input class="form-control" name="secondLastName" type="text" placeholder="Segundo Apellido" />
                                        <label >Segundo Apellido</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="idNumber" type="text" placeholder="Cédula/DNI" required />
                                        <label >Cédula / DNI</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control"  name="phone" type="tel" placeholder="Teléfono" />
                                        <label>Teléfono</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" type="email" placeholder="Correo electronico" required />
                                <label >Correo electronico</label>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="username" type="text" placeholder="Nombre de Usuario" required />
                                        <label >Nombre de Usuario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" name="password" type="password" placeholder="Contraseña" required />
                                        <label >Contraseña</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="role" required>
                                            <option value="admin">Administrador</option>
                                            <option value="mechanic">Mecánico</option>
                                            <option value="client">Cliente</option>
                                        </select>
                                        <label >Rol</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" name="address" type="text" placeholder="Dirección" />
                                        <label >Dirección</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control"  name="notes" type="text" placeholder="Notas" />
                                <label >Notas</label>
                            </div>
                            
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-success btn-block" type="submit">Registrar Usuario</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

@endsection




