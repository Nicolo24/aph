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
                        <div class="float-start">
                            <span class="card-title">Seguimiento de la ruta</span>
                        </div>
                        <div class="float-end">

                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>


                    <div class="card-body">
                        <div class="float-start">

                            <div class="form-group">
                                <strong>Recurso:</strong>
                                <span id="resource_id"></span>
                            </div>
                            <div class="form-group">
                                <strong>Usuario:</strong>
                                <span id="user_id"></span>
                            </div>
                            <div class="form-group">
                                <strong>Punto de inicio:</strong>
                                <span id="start_address"></span>
                            </div>
                            <div class="form-group">
                                <strong>Punto de recogida:</strong>
                                <span id="emergency_address"></span>
                            </div>
                            <div class="form-group">
                                <strong>Punto de destino:</strong>
                                <span id="destination_address"></span>
                            </div>
                            <div class="form-group">
                                <strong>Hora de Inicio:</strong>
                                <span id="start_time"></span>
                            </div>
                            <div class="form-group">
                                <strong>Hora de recogida:</strong>
                                <span id="pickup_time"></span>
                            </div>
                            <div class="form-group">
                                <strong>Hora de fin:</strong>
                                <span id="end_time"></span>
                            </div>
                            <div class="form-group">
                                <strong>Instrucciones:</strong>
                                <span id="instructions"></span>
                            </div>
                            <div class="form-group">
                                <strong>Estado:</strong>
                                <span id="status"></span>
                            </div>
                        </div>

                        <div class="float-end">


                            <h6><i class="fas fa-circle" style="color: green;"></i> = Ruta de ida</h6>
                            <h6><i class="fas fa-circle" style="color: blue;"></i> = Ruta de regreso</h6>
                            <h6><i class="fas fa-map-marker-alt" style="color: green;"></i> = Punto de inicio</h6>
                            <h6><i class="fas fa-map-marker-alt" style="color: red;"></i> = Punto de recogida</h6>
                            <h6><i class="fas fa-map-marker-alt" style="color: blue;"></i> = Punto de destino</h6>


                        </div>
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

                            var goPolyline = L.polyline([], {
                                color: 'green'
                            }).addTo(map);

                            var returnPolyline = L.polyline([], {
                                color: 'blue'
                            }).addTo(map);

                            function fetchRoutePoints() {
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            var response = JSON.parse(xhr.responseText);
                                            var points = response.points;
                                            var goPoints = response.go_points;
                                            var returnPoints = response.return_points;
                                            //routePolyline.setLatLngs(points);
                                            goPolyline.setLatLngs(goPoints);
                                            returnPolyline.setLatLngs(returnPoints);
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
                                    document.getElementById("resource_id").textContent = response.route.resource ? response.route
                                        .resource.name : 'Sin asignar';
                                    document.getElementById("user_id").textContent = response.route.user ? response.route.user.name :
                                        'Sin asignar';
                                    document.getElementById("start_address").textContent = response.route.start_address;
                                    document.getElementById("emergency_address").textContent = response.route.emergency_address;
                                    document.getElementById("destination_address").textContent = response.route.destination_address;
                                    document.getElementById("start_time").textContent = response.route.start_time ? response.route
                                        .start_time : 'Sin iniciar';
                                    document.getElementById("pickup_time").textContent = response.route.pickup_time ? response.route
                                        .pickup_time : 'Sin recoger';
                                    document.getElementById("end_time").textContent = response.route.end_time ? response.route
                                        .end_time : 'Sin finalizar';
                                    document.getElementById("instructions").textContent = response.route.instructions ? response.route
                                        .instructions : 'Sin instrucciones';
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
