<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Clima en Ciudades</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Ciudades Registradas</h2>
            <a href="{{ route('cities.create') }}" class="btn btn-primary">+ Registrar Ciudad</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="list-group list-group-flush">
                        @foreach($cities as $city)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span style="cursor:pointer" onclick="getWeather({{ $city->latitude }}, {{ $city->longitude }}, '{{ $city->name }}', '{{ asset('storage/' . $city->image_path) }}')">
                                    {{ $city->name }}
                                </span>
                                <form action="{{ route('cities.destroy', $city->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">x</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div id="weather-widget" class="card shadow-sm p-4 text-center" style="min-height: 200px;">
                    <div class="my-auto">
                        <h4 class="text-muted">Selecciona una ciudad para consultar el clima</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getWeather(lat, lon, name, imageUrl) {
            const widget = document.getElementById('weather-widget');
            widget.innerHTML = `<div class="spinner-border text-primary" role="status"></div>`;
            
            const apiKey = "{{ env('WEATHER_API_KEY') }}";
            fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric&lang=es`)
                .then(response => response.json())
                .then(data => {
                    widget.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <img src="${imageUrl}" class="img-fluid rounded shadow-sm" alt="${name}" style="max-height: 200px; object-fit: cover;">
                            </div>
                            <div class="col-md-6 my-auto">
                                <h3>Clima en ${name}</h3>
                                <h1 class="display-5">${Math.round(data.main.temp)}°C</h1>
                                <p class="text-capitalize">${data.weather[0].description}</p>
                                <p>Viento: <strong>${data.wind.speed} m/s</strong> | Humedad: <strong>${data.main.humidity}%</strong></p>
                            </div>
                        </div>
                    `;
                });
        }
    </script>
</body>
</html>