<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="#">Gestión</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>
