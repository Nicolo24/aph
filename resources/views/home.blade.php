@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center p-2 text-white bg-secondary rounded shadow-sm">
        <i class="fa-solid fa-truck-medical" style="font-size: 2.5em;"></i>
        <div class="lh-1 px-3">
            <h1 class="h6 mb-0 text-white lh-1">{{ Auth::user()->usertype->name }}</h1>
            <small>{{ Auth::user()->institution->name }} - {{ Auth::user()->zone->name }}</small>
        </div>
    </div>



    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-1 mt-1">

        <div class="card col-md align-self-stretch vh-100">
            <div class="card-header">
                <div class="float-start">
                    Mapa
                </div>
                <div class="float-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="autorefresh-checkbox">
                        <label class="form-check-label" for="autorefresh-checkbox">Autorefresh (5 sec)</label>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var autorefreshInterval;
                            var timeoutId;
                            var intervalDelay = 5000; // Intervalo de autorefresco en milisegundos
                            var activityTimeout = 2000; // Tiempo en milisegundos para detener el autorefresco después de la actividad del usuario

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
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.reload()">Refrescar</button>

                </div>
            </div>
            <div class="card-body h-100" id="map-container">
                <div id="map" style="height: 100%;"></div>
            </div>
        </div>

        <div class="card shadow-sm col-md-auto vh-100">
            <div class="card-header">
                Bases
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    var scrollpos = localStorage.getItem('bases-scrollpos');
                    if (scrollpos) document.getElementById('bases-list').scrollTop = scrollpos;
                });

                window.onbeforeunload = function(e) {
                    localStorage.setItem('bases-scrollpos', document.getElementById('bases-list').scrollTop);
                };
            </script>

            <div class="card-body  overflow-auto" id="bases-list">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                @foreach (Auth::user()->bases as $base)
                    <div class="card mb-2">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item me-auto">
                                    {{ $base->icon }} <a target="_blank" class="fw-bold" href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a>
                                </li>
                                <li class="nav-item ms-auto">
                                    <form action="{{ route('assign') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="base_id" value="{{ $base->id }}">
                                        <select class="form-select form-select-sm" name="resource_id" id="resource_id" onchange="form.submit()">
                                            <option value="0">Select Resource</option>
                                            @foreach ($base->available_resources as $resource)
                                                <option value="{{ $resource->id }}">{{ $resource->icon }} {{ $resource->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Resource</th>
                                        <th scope="col">Assigned By</th>
                                        <th scope="col">Since</th>
                                        <th scope="col" class=" text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($base->assigned_resources as $assignation)
                                        <tr>

                                            <td class="dropdown align-middle">
                                                <div class="dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                                        title="{{ $assignation->resource->last_report->created_at->subHours(5) ?? '' }} - {{ $assignation->resource->last_report->comment ?? '' }}">
                                                        {{ $assignation->resource->icon }}
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
                                                                                    {{ Form::radio('reporttype_id', $reporttype->id, $assignation->resource->reporttype_id == $reporttype->id, ['id' => 'reporttype_id']) }}
                                                                                    {{ Form::label('reporttype_id', $reporttype->name) }}
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group mt-2">
                                                                            {{ Form::textarea('comment', '', ['class' => 'form-control', 'style' => 'width: 200px; height: 100px;', 'placeholder' => 'Escribe tu comentario aquí']) }}
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><a target="_blank" href="{{ route('resources.show', $assignation->resource->id) }}">{{ $assignation->resource->name }}</a></td>
                                            <td class="align-middle">{{ $assignation->user->name }}</td>
                                            <td class="align-middle">{{ $assignation->created_at->subHours(5) }}</td>




                                            <form action="{{ route('unassign') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="assignation_id" value="{{ $assignation->id }}">
                                                <td class="align-middle text-end">
                                                    <button type="submit" class="btn btn-link">
                                                        <i class="fa-solid fa-xmark fa-2xl" style="color: #ff0000;"></i>
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css">

        <script>
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
                            {{ $base->icon }} <a target="_blank" class="fw-bold" href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <form action="{{ route('assign') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="base_id" value="{{ $base->id }}">
                                    <select class="form-select form-select-sm select-hide-selected" name="resource_id" id="resource_id" onchange="form.submit()">
                                    <option value="0">Add</option>
                                    @foreach ($base->available_resources as $resource)
                                    <option value="{{ $resource->id }}">{{ $resource->icon }} {{ $resource->name }}</option>
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
                                                        title="{{ $assignation->resource->last_report->created_at->subHours(5) ?? '' }} - {{ $assignation->resource->last_report->comment ?? '' }}">
                                                        {{ $assignation->resource->icon }}
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
                                                                                    {{ Form::radio('reporttype_id', $reporttype->id, $assignation->resource->reporttype_id == $reporttype->id, ['id' => 'reporttype_id']) }}
                                                                                    {{ Form::label('reporttype_id', $reporttype->name) }}
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group mt-2">
                                                                            {{ Form::textarea('comment', '', ['class' => 'form-control', 'style' => 'width: 200px; height: 100px;', 'placeholder' => 'Escribe tu comentario aquí']) }}
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                <a href="{{ route('resources.show', $assignation->resource->id) }}" class="flex-grow-1 me-3">{{ $assignation->resource->name }}</a>
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
        </script>
    </div>
@endsection
