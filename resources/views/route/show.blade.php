@extends('layouts.app')

@section('template_title')
    {{ $route->name ?? 'Show Route' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Route</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('routes.index') }}"> Back</a>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>


                    <div class="card-body">

                        <div class="form-group">
                            <strong>ID de Recurso:</strong>
                            <span id="resource_id"></span>
                        </div>
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            <span id="user_id"></span>
                        </div>
                        <div class="form-group">
                            <strong>Start Address:</strong>
                            <span id="start_address"></span>
                        </div>
                        <div class="form-group">
                            <strong>Emergency Address:</strong>
                            <span id="emergency_address"></span>
                        </div>
                        <div class="form-group">
                            <strong>Destination Address:</strong>
                            <span id="destination_address"></span>
                        </div>
                        <div class="form-group">
                            <strong>Start Time:</strong>
                            <span id="start_time"></span>
                        </div>
                        <div class="form-group">
                            <strong>Pickup Time:</strong>
                            <span id="pickup_time"></span>
                        </div>
                        <div class="form-group">
                            <strong>End Time:</strong>
                            <span id="end_time"></span>
                        </div>
                        <div class="form-group">
                            <strong>Instructions:</strong>
                            <span id="instructions"></span>
                        </div>
                        <h1>Estado de la Ruta</h1>
                        <h2>Estado: <span id="status"></span></h2>

                        <div id="map" style="height: 400px;width:100%"></div>

                        <script>
                            // Puntos de inicio, emergencia y recogida de ejemplo
                            var startPoint = [parseFloat({{ $route->start_latitude }}), parseFloat({{ $route->start_longitude }})];
                            var emergencyPoint = [parseFloat({{ $route->emergency_latitude }}), parseFloat(
                                {{ $route->emergency_longitude }})];
                            var pickupPoint = [parseFloat({{ $route->destination_latitude }}), parseFloat(
                                {{ $route->destination_longitude }})];

                            var map = L.map('map').setView(startPoint, 13);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: 'Map data &copy; OpenStreetMap contributors'
                            }).addTo(map);

                            // Marcadores para los puntos de inicio, emergencia y recogida
                            L.marker(startPoint, {
                                icon: L.icon({
                                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).addTo(map).bindPopup('Punto de inicio');
                            L.marker(emergencyPoint, {
                                icon: L.icon({
                                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).addTo(map).bindPopup('Punto de emergencia');
                            L.marker(pickupPoint, {
                                icon: L.icon({
                                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).addTo(map).bindPopup('Punto de recogida');

                            //create a group anmd center map on it
                            var group = new L.featureGroup([L.marker(startPoint), L.marker(emergencyPoint), L.marker(pickupPoint)]);
                            map.fitBounds(group.getBounds());

                            var routePolyline = L.polyline([], {
                                color: 'red'
                            }).addTo(map);

                            function fetchRoutePoints() {
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            var response = JSON.parse(xhr.responseText);
                                            var points = response.points;
                                            routePolyline.setLatLngs(points);
                                        }
                                    }
                                };

                                xhr.open('GET', '{{ route('route.getPoints', $route->id) }}', false);
                                xhr.send();
                            }

                            fetchRoutePoints();
                            setInterval(fetchRoutePoints, 1000);
                        </script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                // Función para realizar la consulta AJAX
                                function fetchData() {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("GET", "{{ route('items.route', $route->id) }}", true);
                                    xhr.setRequestHeader("Content-Type", "application/json");
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            var response = JSON.parse(xhr.responseText);
                                            // Actualizar el contenido en el documento HTML
                                            updateContent(response);
                                        } else if (xhr.readyState === 4 && xhr.status !== 200) {
                                            console.error("Error: " + xhr.status);
                                        }
                                    };
                                    xhr.send();
                                }

                                // Función para actualizar el contenido en el documento HTML
                                function updateContent(response) {
                                    // Actualizar los elementos HTML con los datos de la respuesta
                                    document.getElementById("resource_id").textContent = response.route.resource_id;
                                    document.getElementById("user_id").textContent = response.route.user_id;
                                    document.getElementById("start_address").textContent = response.route.start_address;
                                    document.getElementById("emergency_address").textContent = response.route.emergency_address;
                                    document.getElementById("destination_address").textContent = response.route.destination_address;
                                    document.getElementById("start_time").textContent = response.route.start_time;
                                    document.getElementById("pickup_time").textContent = response.route.pickup_time;
                                    document.getElementById("end_time").textContent = response.route.end_time;
                                    document.getElementById("instructions").textContent = response.route.instructions;
                                    document.getElementById("status").textContent = response.route.status;

                                    // Realizar la siguiente llamada AJAX después de 5 segundos
                                    setTimeout(fetchData, 5000);
                                }

                                // Iniciar la consulta AJAX
                                fetchData();
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
