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
                            {{ $route->resource_id }}
                        </div>
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $route->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Start Address:</strong>
                            {{ $route->start_address }}
                        </div>
                        <div class="form-group">
                            <strong>Start Latitude:</strong>
                            {{ $route->start_latitude }}
                        </div>
                        <div class="form-group">
                            <strong>Start Longitude:</strong>
                            {{ $route->start_longitude }}
                        </div>
                        <div class="form-group">
                            <strong>Emergency Address:</strong>
                            {{ $route->emergency_address }}
                        </div>
                        <div class="form-group">
                            <strong>Emergency Latitude:</strong>
                            {{ $route->emergency_latitude }}
                        </div>
                        <div class="form-group">
                            <strong>Emergency Longitude:</strong>
                            {{ $route->emergency_longitude }}
                        </div>
                        <div class="form-group">
                            <strong>Destination Address:</strong>
                            {{ $route->destination_address }}
                        </div>
                        <div class="form-group">
                            <strong>Start Time:</strong>
                            {{ $route->start_time }}
                        </div>
                        <div class="form-group">
                            <strong>Pickup Time:</strong>
                            {{ $route->pickup_time }}
                        </div>
                        <div class="form-group">
                            <strong>End Time:</strong>
                            {{ $route->end_time }}
                        </div>
                        <div class="form-group">
                            <strong>Destination Latitude:</strong>
                            {{ $route->destination_latitude }}
                        </div>
                        <div class="form-group">
                            <strong>Destination Longitude:</strong>
                            {{ $route->destination_longitude }}
                        </div>
                        <div class="form-group">
                            <strong>Instructions:</strong>
                            {{ $route->instructions }}
                        </div>
                        <h1>Estado de la Ruta</h1>
                        <h2>Estado: {{ $route->status }}</h2>

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

                            var routePolyline = L.polyline([], { color: 'red' }).addTo(map);

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

                                xhr.open('GET', '{{ route('route.getPoints',$route->id) }}', false);
                                xhr.send();
                            }

                            fetchRoutePoints();
                            setInterval(fetchRoutePoints, 1000);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
