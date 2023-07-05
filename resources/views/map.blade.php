@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center p-2 text-white bg-secondary rounded shadow-sm mb-2">
        <i class="fa-solid fa-truck-medical" style="font-size: 2.5em;"></i>
        <div class="lh-1 px-3">
            <h1 class="h6 mb-0 text-white lh-1">{{ Auth::user()->usertype->name }}</h1>
            <small>{{ Auth::user()->institution->name }} - {{ Auth::user()->zone->name }}</small>
        </div>
    </div>

    <div class="card" id="map-card">
        <script>
            const elementsAboveCard = document.querySelector('#map-card').getBoundingClientRect().top;
            const card = document.querySelector('#map-card');
            card.style.height = `calc(98vh - ${elementsAboveCard}px)`;
        </script>
        <div class="card-header">
            <div class="float-start">
                Mapa
            </div>
            <div class="float-end d-flex justify-content-between">
                <div class="form-check ">
                    <input class="form-check-input align-middle" type="checkbox" id="autorefresh-checkbox">
                    <label class="form-check-label align-middle" for="autorefresh-checkbox">Autorefresco (5
                        sec)</label>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var autorefreshInterval;
                        var timeoutId;
                        var intervalDelay = 5000; // Intervalo de autorefresco en milisegundos
                        var activityTimeout =
                            2000; // Tiempo en milisegundos para detener el autorefresco después de la actividad del usuario

                        function refresh() {
                            location.reload();
                        }

                        var checkbox = document.getElementById('autorefresh-checkbox');

                        checkbox.addEventListener('change', function() {
                            if (this.checked) {
                                autorefreshInterval = setInterval(refresh, intervalDelay);
                                localStorage.setItem('autorefreshInterval', autorefreshInterval);

                                // Detener temporalmente el autorefresco si hay actividad del mouse o del teclado
                                document.addEventListener('mousemove', handleUserActivity);
                                document.addEventListener('keydown', handleUserActivity);
                            } else {
                                clearInterval(autorefreshInterval);
                                localStorage.removeItem('autorefreshInterval');

                                // Detener la detección de actividad del mouse y del teclado
                                document.removeEventListener('mousemove', handleUserActivity);
                                document.removeEventListener('keydown', handleUserActivity);

                                // Limpiar el temporizador de espera
                                clearTimeout(timeoutId);
                            }
                        });

                        function handleUserActivity() {
                            // Reiniciar el temporizador de espera
                            clearTimeout(timeoutId);

                            // Detener el autorefresco durante un período de tiempo después de la actividad del usuario
                            clearInterval(autorefreshInterval);
                            timeoutId = setTimeout(function() {
                                autorefreshInterval = setInterval(refresh, intervalDelay);
                            }, activityTimeout);
                        }

                        // Comprobar si el intervalo de autorefresco estaba activo anteriormente
                        if (localStorage.getItem('autorefreshInterval')) {
                            checkbox.checked = true;
                            autorefreshInterval = setInterval(refresh, intervalDelay);

                            // Iniciar la detección de actividad del mouse y del teclado
                            document.addEventListener('mousemove', handleUserActivity);
                            document.addEventListener('keydown', handleUserActivity);
                        }
                    });
                </script>
                <button type="button" class="btn btn-sm btn-outline-secondary ms-4" onclick="location.reload()">Refrescar</button>

            </div>
        </div>
        <div class="card-body h-100" id="map-container">
            <div id="map" style="height: 100%;"></div>
        </div>
    </div>



    <script id="map-script">
        document.addEventListener('DOMContentLoaded', function() {
            var mymap = L.map('map').setView([-1.8312, -78.1834], 6);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(mymap);

            var markers = L.layerGroup().addTo(mymap);
            var group = L.featureGroup();

            var greenIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            var redIcon = L.icon({
                iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });


            @foreach (Auth::user()->bases as $base)
                var marker = L.marker([{{ $base->latitude }}, {{ $base->longitude }}], {
                    icon: {{ $base->is_operative ? 'greenIcon' : 'redIcon' }}
                });
                var popupContent = `
                    <div class="card">
                        <div class="card-header">
                            {!! $base->icon !!} <a target="_blank" class="fw-bold" href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <form action="{{ route('assign') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="base_id" value="{{ $base->id }}">
                                    <select class="form-select form-select-sm select-hide-selected" name="resource_id" id="resource_id" onchange="form.submit()">
                                    <option value="0">Agregar</option>
                                    @foreach ($base->available_resources as $resource)
                                    <option value="{{ $resource->id }}">{{ $resource->name }} ({{ $resource->last_report ? $resource->last_report->reporttype->name : 'Sin reportes' }})</option>
                                    @endforeach
                                    </select>
                                </form>
                            </div>
                            @foreach ($base->assigned_resources as $assignation)
                            <li class="list-group-item">
                                <div class="card-item d-flex justify-content-between align-items-center">
                                    <td class="dropdown align-middle">
                                                <div class="dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                                        title="{{ $assignation->resource->last_report ? $assignation->resource->last_report->created_at->subHours(5) : '' }} - {{ $assignation->resource->last_report->comment ?? '' }}">
                                                        {!! $assignation->resource->icon !!}
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form action="{{ route('report') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="resource_id" value="{{ $assignation->resource->id }}">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            @foreach (\App\Models\Reporttype::all() as $reporttype)
                                                                            <div class="form-group text-wrap">
                                                                                <div class="form-check form-check-inline">
                                                                                    {{ Form::radio('reporttype_id', $reporttype->id, $assignation->resource->reporttype_id == $reporttype->id, ['class' => 'form-check-input', 'id' => 'reporttype_id']) }}
                                                                                    {{ Form::label('reporttype_id', $reporttype->name, ['class' => 'form-check-label']) }}
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group mt-2">
                                                                            {{ Form::textarea('comment', '', ['class' => 'form-control', 'style' => 'width: 250px; height: 100px;', 'placeholder' => 'Escribe tu comentario aquí']) }}
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                <a href="{{ route('resources.show', $assignation->resource->id) }}" class="flex-grow-1 me-3" target="_blank">{{ $assignation->resource->name }}</a>
                                <form action="{{ route('unassign') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="assignation_id" value="{{ $assignation->id }}">
                                    <button type="submit" class="btn btn-link"><i class="fa-solid fa-xmark fa-2xl" style="color: #ff0000;"></i></button>
                                </form>
                                </div>
                            </li>
                            @endforeach
                        </div>
                    </div>
                `;
                marker.bindPopup(popupContent);
                marker.bindTooltip('{{ $base->name }}');
                group.addLayer(marker);
            @endforeach

            group.eachLayer(function(layer) {
                markers.addLayer(layer);
            });

            mymap.addLayer(markers);
            mymap.fitBounds(group.getBounds());

        });
    </script>
@endsection
