<div class="box box-info p-1">
    <div class="box-body">

        <!-- Leaflet JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>

        <!-- Leaflet Routing Machine -->
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


        <div class="form-group">
            {{ Form::label('resource_id') }}
            {{ Form::select('resource_id', Auth::user()->resources->pluck('name', 'id'), $route->resource_id, ['class' => 'form-control' . ($errors->has('resource_id') ? ' is-invalid' : ''), 'placeholder' => 'Select Resource']) }}
            {!! $errors->first('resource_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div id="map" style="height: 400px; width: 100%;"></div>
        <div class="form-group">
            {{ Form::label('route locations') }}
            <div class="accordion" id="accLocations">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Start Info
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse {{ $warning ?? false ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accLocations">
                        <div class="accordion-body">
                            <div class="form-group">
                                {{ Form::label('start_address') }}
                                {{ Form::text('start_address', $route->start_address, ['class' => 'form-control' . ($errors->has('start_address') ? ' is-invalid' : ''), 'placeholder' => 'Punto de inicio', 'id' => 'start_address']) }}
                                {!! $errors->first('start_address', '<div class="invalid-feedback">:message</div>') !!}
                                <button type="button" class="btn btn-primary" id="start_button">Search</button>
                            </div>
                            <div class="form-group">
                                {{ Form::label('start_latitude') }}
                                {{ Form::text('start_latitude', $route->start_latitude, ['class' => 'form-control' . ($errors->has('start_latitude') ? ' is-invalid' : ''), 'placeholder' => 'Start Latitude', 'id' => 'start_latitude']) }}
                                {!! $errors->first('start_latitude', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('start_longitude') }}
                                {{ Form::text('start_longitude', $route->start_longitude, ['class' => 'form-control' . ($errors->has('start_longitude') ? ' is-invalid' : ''), 'placeholder' => 'Start Longitude', 'id' => 'start_longitude']) }}
                                {!! $errors->first('start_longitude', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Emergency Info
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accLocations">
                        <div class="accordion-body">
                            <div class="form-group">
                                {{ Form::label('emergency_address') }}
                                {{ Form::text('emergency_address', $route->emergency_address, ['class' => 'form-control' . ($errors->has('emergency_address') ? ' is-invalid' : ''), 'placeholder' => 'Punto de recogida', 'id' => 'emergency_address']) }}
                                {!! $errors->first('emergency_address', '<div class="invalid-feedback">:message</div>') !!}
                                <button type="button" class="btn btn-primary" id="emergency_button">Search</button>
                            </div>
                            <div class="form-group">
                                {{ Form::label('emergency_latitude') }}
                                {{ Form::text('emergency_latitude', $route->emergency_latitude, ['class' => 'form-control' . ($errors->has('emergency_latitude') ? ' is-invalid' : ''), 'placeholder' => 'Emergency Latitude', 'id' => 'emergency_latitude']) }}
                                {!! $errors->first('emergency_latitude', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('emergency_longitude') }}
                                {{ Form::text('emergency_longitude', $route->emergency_longitude, ['class' => 'form-control' . ($errors->has('emergency_longitude') ? ' is-invalid' : ''), 'placeholder' => 'Emergency Longitude', 'id' => 'emergency_longitude']) }}
                                {!! $errors->first('emergency_longitude', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Destination Info
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse {{ $warning ?? false ? 'show' : '' }}" aria-labelledby="headingThree" data-bs-parent="#accLocations">
                        <div class="accordion-body">
                            <div class="form-group">
                                {{ Form::label('destination_address') }}
                                {{ Form::text('destination_address', $route->destination_address, ['class' => 'form-control' . ($errors->has('destination_address') ? ' is-invalid' : ''), 'placeholder' => 'Punto de destino', 'id' => 'destination_address']) }}
                                {!! $errors->first('destination_address', '<div class="invalid-feedback">:message</div>') !!}
                                <button type="button" class="btn btn-primary" id="destination_button">Search</button>
                            </div>
                            <div class="form-group">
                                {{ Form::label('destination_latitude') }}
                                {{ Form::text('destination_latitude', $route->destination_latitude, ['class' => 'form-control' . ($errors->has('destination_latitude') ? ' is-invalid' : ''), 'placeholder' => 'Destination Latitude', 'id' => 'destination_latitude']) }}
                                {!! $errors->first('destination_latitude', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('destination_longitude') }}
                                {{ Form::text('destination_longitude', $route->destination_longitude, ['class' => 'form-control' . ($errors->has('destination_longitude') ? ' is-invalid' : ''), 'placeholder' => 'Destination Longitude', 'id' => 'destination_longitude']) }}
                                {!! $errors->first('destination_longitude', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Obtén los elementos de entrada de latitud, longitud y dirección para los tres marcadores
            var emergencyLatitudeInput = document.getElementById('emergency_latitude');
            var emergencyLongitudeInput = document.getElementById('emergency_longitude');
            var emergencyAddressInput = document.getElementById('emergency_address');
            var emergencyButton = document.getElementById('emergency_button');

            var startLatitudeInput = document.getElementById('start_latitude');
            var startLongitudeInput = document.getElementById('start_longitude');
            var startAddressInput = document.getElementById('start_address');
            var startButton = document.getElementById('start_button');

            var destinationLatitudeInput = document.getElementById('destination_latitude');
            var destinationLongitudeInput = document.getElementById('destination_longitude');
            var destinationAddressInput = document.getElementById('destination_address');
            var destinationButton = document.getElementById('destination_button');

            // Crea un mapa en el elemento con ID 'map' para los tres marcadores
            var map = L.map('map').setView([0, 0], 13);

            // Crea una capa de mapa base utilizando OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);

            // Crea los marcadores iniciales en el centro del mapa
            // marcador de inicio color azul, emergencia rojo, destino verde
            // agrega un texto a cada marcador, inicio, emergencia y destino
            var emergencyMarker = L.marker([0, 0], {
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

            var startMarker = L.marker([0, 0], {
                draggable: true,
                icon: L.icon({
                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(map);

            var destinationMarker = L.marker([0, 0], {
                draggable: true,
                icon: L.icon({
                    iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(map);

            startMarker.bindTooltip("Start", {
                permanent: true,
                direction: 'left'
            });

            emergencyMarker.bindTooltip("Emergency", {
                permanent: true,
                direction: 'bottom'
            });

            destinationMarker.bindTooltip("Destination", {
                permanent: true,
                direction: 'right'
            });

            var group = new L.featureGroup([emergencyMarker, startMarker, destinationMarker]);

            // Actualiza la posición del marcador al moverlo
            emergencyMarker.on('dragend', function(event) {
                var markerLatLng = emergencyMarker.getLatLng();
                updateMarkerPosition(markerLatLng.lat, markerLatLng.lng, emergencyLatitudeInput,
                    emergencyLongitudeInput, emergencyMarker);
                getReverseGeocode(markerLatLng.lat, markerLatLng.lng, emergencyAddressInput);
            });

            // Ajusta el mapa al marcador al hacer doble clic
            emergencyMarker.on('dblclick', function(event) {
                map.fitBounds(emergencyMarker.getLatLng().toBounds(10)); // Ajusta el zoom y posición del mapa
            });

            startMarker.on('dragend', function(event) {
                var markerLatLng = startMarker.getLatLng();
                updateMarkerPosition(markerLatLng.lat, markerLatLng.lng, startLatitudeInput, startLongitudeInput,
                    startMarker);
                getReverseGeocode(markerLatLng.lat, markerLatLng.lng, startAddressInput);
            });

            startMarker.on('dblclick', function(event) {
                map.fitBounds(startMarker.getLatLng().toBounds(10));
            });

            destinationMarker.on('dragend', function(event) {
                var markerLatLng = destinationMarker.getLatLng();
                updateMarkerPosition(markerLatLng.lat, markerLatLng.lng, destinationLatitudeInput,
                    destinationLongitudeInput, destinationMarker);
                getReverseGeocode(markerLatLng.lat, markerLatLng.lng, destinationAddressInput);
            });

            destinationMarker.on('dblclick', function(event) {
                map.fitBounds(destinationMarker.getLatLng().toBounds(10));
            });


            // Función genérica para actualizar las coordenadas de latitud y longitud y centra el mapa en la posición del marcador
            function updateMarkerPosition(latitude, longitude, latitudeInput, longitudeInput, marker) {
                latitudeInput.value = latitude;
                longitudeInput.value = longitude;
                marker.setLatLng([latitude, longitude]);
            }

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

            // Función para buscar la dirección ingresada y ubicar el marcador en la primera coincidencia
            function searchAddress(addressInput, latitudeInput, longitudeInput, marker) {
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
                        updateMarkerPosition(latitude, longitude, latitudeInput, longitudeInput, marker);
                        //actualiza addressInput.value con la direccion encontrada
                        addressInput.value = result.formatted_address;
                    } else {
                        alert('Dirección no encontrada!');
                    }
                } else {
                    console.error('Error:', request.status);
                    alert('Error al buscar la dirección.');
                }
                map.fitBounds(group.getBounds());

            }

            // Establece las direcciones iniciales de los usuarios como el valor de búsqueda y centra el mapa
            emergencyAddressInput.value = "{{ Auth::user()->center->name }}";
            searchAddress(emergencyAddressInput, emergencyLatitudeInput, emergencyLongitudeInput, emergencyMarker);
            //actualizar posicion del marcador de inicio a la latitud y longitud de los inputs de start
            updateMarkerPosition(startLatitudeInput.value, startLongitudeInput.value, startLatitudeInput,
                startLongitudeInput, startMarker);
            //actualizar posicion del marcador de destino a la latitud y longitud de los inputs de destination
            updateMarkerPosition(parseFloat(destinationLatitudeInput.value) + 0.0002, destinationLongitudeInput.value,
                destinationLatitudeInput,
                destinationLongitudeInput, destinationMarker);


            // Manejadores de eventos para los botones de búsqueda
            emergencyButton.addEventListener('click', function() {
                searchAddress(emergencyAddressInput, emergencyLatitudeInput, emergencyLongitudeInput, emergencyMarker);
            });

            startButton.addEventListener('click', function() {
                searchAddress(startAddressInput, startLatitudeInput, startLongitudeInput, startMarker);
            });

            destinationButton.addEventListener('click', function() {
                searchAddress(destinationAddressInput, destinationLatitudeInput, destinationLongitudeInput,
                    destinationMarker);
            });

            // crea un grupo entre los tres marcadores y centra el mapa en el grupo
            map.fitBounds(group.getBounds());
        </script>


        <div class="form-group">
            {{ Form::label('instructions') }}
            {{ Form::text('instructions', $route->instructions, ['class' => 'form-control' . ($errors->has('instructions') ? ' is-invalid' : ''), 'placeholder' => 'Instrucciones']) }}
            {!! $errors->first('instructions', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
