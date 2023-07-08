@extends('layouts.app')

@section('template_title')
    Create Route
@endsection

@section('content')
    <section class="content container-fluid">

        <!-- Leaflet JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>

        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Busca el mejor recurso disponible</span>
                    </div>
                    <div class="card-body">
                        {{ route('routes.create') }}
                        <form>
                            <div class="input-group mb-3">
                                <input type="text" id="address" class="form-control" placeholder="Ingresa una dirección">
                                <button class="btn btn-primary" type="button" id="search-button"><i class="fas fa-search"></i></button>
                            </div>
                        </form>

                            <div class="flex-grow-1">

                                <div class="card">
                                    <div class="card-header">Mapa</div>
                                    <div class="card-body">
                                        <div id="mapid" style="height: 400px"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card m1-2">
                                <div class="card-header">Rutas disponibles</div>
                                <div class="card-body">
                                    <table id="table-possible-routes" class="table table-responsive">
                                    </table>
                                </div>
                            </div>


                        <script>
                            var inputAddress = document.getElementById('address');
                            var searchButton = document.getElementById('search-button');

                            map = L.map('mapid').setView([-1.831239, -78.183406], 8);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 18,

                            }).addTo(map);

                            emergencyMarker = L.marker([-1.831239, -78.183406], {
                                draggable: true,
                                icon: L.icon({
                                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).addTo(map);

                            emergencyMarker.on('dragend', function(event) {
                                var markerLatLng = emergencyMarker.getLatLng();
                                getReverseGeocode(markerLatLng.lat, markerLatLng.lng, inputAddress);
                                getPossibleRoutes();

                            });

                            function getReverseGeocode(latitude, longitude, addressInput) {
                                var apiUrl = '{{ route('items.getReverseGeocode') }}?latlng=' + encodeURIComponent(latitude) + ',' +
                                    encodeURIComponent(longitude)

                                // Realiza la solicitud HTTP para obtener la dirección utilizando la Geocoding API de Google Maps
                                var request = new XMLHttpRequest();
                                request.open('GET', apiUrl, false); // El tercer parámetro en false indica una solicitud síncrona
                                request.send();

                                if (request.status === 200) {
                                    var data = JSON.parse(request.responseText);

                                    if (data.results.length > 0) {
                                        var result = data.results[0];
                                        addressInput.value = result.formatted_address;
                                    } else {
                                        alert('Dirección no encontrada!');
                                    }
                                } else {
                                    console.error('Error:', request.status);
                                    alert('Error al buscar la dirección.');
                                }
                            }

                            function searchAddress(addressInput, marker) {
                                var address = addressInput.value;
                                var apiUrl = '{{ route('items.getAllGeocodes') }}?address=' + encodeURIComponent(address)

                                // Realiza la solicitud HTTP para obtener las coordenadas de la dirección utilizando la Geocoding API de Google Maps
                                var request = new XMLHttpRequest();
                                request.open('GET', apiUrl, false); // El tercer parámetro en false indica una solicitud síncrona
                                request.send();

                                if (request.status === 200) {
                                    var data = JSON.parse(request.responseText);

                                    if (data.results.length > 0) {
                                        var result = data.results[0];
                                        var latitude = result.geometry.location.lat;
                                        var longitude = result.geometry.location.lng;

                                        // Actualiza las coordenadas y la posición del marcador
                                        updateMarkerPosition(latitude, longitude, marker);
                                        //actualiza addressInput.value con la direccion encontrada
                                        addressInput.value = result.formatted_address;
                                    } else {
                                        alert('Dirección no encontrada!');
                                    }
                                } else {
                                    console.error('Error:', request.status);
                                    alert('Error al buscar la dirección.');
                                }
                                map.setView([latitude, longitude], 15);

                            }

                            function updateMarkerPosition(latitude, longitude, marker) {
                                marker.setLatLng([latitude, longitude]);
                                map.setView([latitude, longitude], 15);
                            }

                            

                            function getPossibleRoutes() {
                                var apiUrl = '{{ route('items.getPossibleRoutes') }}?address=' + encodeURIComponent(inputAddress.value)

                                // Realiza la solicitud HTTP para obtener la dirección utilizando la Geocoding API de Google Maps
                                var request = new XMLHttpRequest();
                                request.open('GET', apiUrl, false); // El tercer parámetro en false indica una solicitud síncrona
                                request.send();

                                if (request.status === 200) {
                                    var data = JSON.parse(request.responseText);
                                    //foreach route in data.routes
                                    //insertar en la tabla los datos de las rutas
                                    var table = document.getElementById("table-possible-routes");
                                    table.innerHTML = '';
                                    //insert thead
                                    var thead = table.createTHead();
                                    var row = thead.insertRow(0);
                                    var cell1 = row.insertCell(0);
                                    var cell2 = row.insertCell(1);
                                    var cell3 = row.insertCell(2);
                                    var cell4 = row.insertCell(3);
                                    var cell5 = row.insertCell(4);

                                    cell1.innerHTML = "<b>Base</b>";
                                    cell2.innerHTML = "<b>Recurso</b>";
                                    cell3.innerHTML = "<b>Distancia</b>";
                                    cell4.innerHTML = "<b>Tiempo</b>";
                                    
                                    //order data.routes by data.routes.time ascending
                                    data.routes.sort(function(a, b) {
                                        return a.time - b.time;
                                    });

                                    for (var i = 0; i < data.routes.length; i++) {
                                        var base = data.routes[i].resource.last_assignation.base.name;
                                        var base_lat = data.routes[i].resource.last_assignation.base.latitude;
                                        var base_lng = data.routes[i].resource.last_assignation.base.longitude;
                                        var destination_lat = data.routes[i].routes.routes[0].legs[0].end_location.lat;
                                        var destination_lng = data.routes[i].routes.routes[0].legs[0].end_location.lng;
                                        var nombre = data.routes[i].resource.name;
                                        var distancia = data.routes[i].distance_text;
                                        var tiempo = data.routes[i].time_text;


                                        var row = table.insertRow(-1);
                                        var cell1 = row.insertCell(0);
                                        var cell2 = row.insertCell(1);
                                        var cell3 = row.insertCell(2);
                                        var cell4 = row.insertCell(3);
                                        var cell5 = row.insertCell(4);

                                        cell1.innerHTML = base;
                                        cell2.innerHTML = nombre;
                                        cell3.innerHTML = distancia;
                                        cell4.innerHTML = tiempo;
                                        cell5.innerHTML = `<a href="{{route('routes.create')}}?resource_id=${data.routes[i].resource.id}&base_lat=${base_lat}&base_lng=${base_lng}&destination_lat=${destination_lat}&destination_lng=${destination_lng}&destination_address=${inputAddress.value}" class="btn btn-primary">Seleccionar</a>`;

                                    }

                                } else {
                                    console.error('Error:', request.status);
                                    alert('Error al buscar la dirección.');
                                }
                            }

                            searchButton.addEventListener('click', function() {
                                searchAddress(inputAddress, emergencyMarker);
                                getPossibleRoutes();
                            });




                        </script>



                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
