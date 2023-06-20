@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center p-2 text-white bg-secondary rounded shadow-sm mb-2">
        <i class="fa-solid fa-truck-medical" style="font-size: 2.5em;"></i>
        <div class="lh-1 px-3">
            <h1 class="h6 mb-0 text-white lh-1">{{ Auth::user()->usertype->name }}</h1>
            <small>{{ Auth::user()->institution->name }} - {{ Auth::user()->zone->name }}</small>
        </div>
    </div>


    <div class="card" id="bases-card">
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
                <button type="button" class="btn btn-sm btn-outline-secondary ms-4"
                    onclick="location.reload()">Refrescar</button>

            </div>
        </div>

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
                                {!! $base->icon !!} <a target="_blank" class="fw-bold"
                                    href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a>
                            </li>
                            <li class="nav-item ms-auto">
                                <form action="{{ route('assign') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="base_id" value="{{ $base->id }}">
                                    <select class="form-select form-select-sm" name="resource_id" id="resource_id"
                                        onchange="form.submit()">
                                        <option value="0">Seleccionar recurso</option>
                                        @foreach ($base->available_resources as $resource)
                                            <option value="{{ $resource->id }}">
                                                {{ $resource->name }}
                                                ({{ $resource->last_report ? $resource->last_report->reporttype->name : 'Sin reportes' }})
                                            </option>
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
                                    <th scope="col">Recurso</th>
                                    <th scope="col">Asignado Por</th>
                                    <th scope="col">Desde</th>
                                    <th scope="col" class=" text-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($base->assigned_resources as $assignation)
                                    <tr>

                                        <td class="dropdown align-middle">
                                            <div class="dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" v-pre
                                                    title="{{ $assignation->resource->last_report ? $assignation->resource->last_report->created_at->subHours(5) : '' }} - {{ $assignation->resource->last_report->comment ?? '' }}">
                                                    {!! $assignation->resource->icon !!}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="{{ route('report') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="resource_id"
                                                                    value="{{ $assignation->resource->id }}">
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
                                                                        <button type="submit"
                                                                            class="btn btn-primary mt-2">Guardar</button>
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
                                        <td class="align-middle"><a target="_blank"
                                                href="{{ route('resources.show', $assignation->resource->id) }}">{{ $assignation->resource->name }}</a>
                                        </td>
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
@endsection
