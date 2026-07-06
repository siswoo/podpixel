<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Ciudad</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="mb-4">Registrar Ciudad</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Nombre de la ciudad</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Latitud</label>
                        <input type="text" name="latitude" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Longitud</label>
                        <input type="text" name="longitude" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Imagen</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Guardar Ciudad</button>
                <div class="mt-3 text-center">
                    <a href="{{ route('cities.index') }}" class="btn btn-outline-secondary">Ver listado de ciudades</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>