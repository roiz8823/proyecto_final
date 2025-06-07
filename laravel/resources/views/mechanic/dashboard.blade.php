<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard MECANICOS</h1>
    <h1>Bienvenido {{ auth()->user()->firstName }}</h1>
    <p>Rol: {{ auth()->user()->role }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>