@extends('layouts.app')

@section('template_title')
    {{ $resource->name ?? 'Show Resource' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                Reportes del recurso
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <th></th>
                        <th>Reporte</th>
                        <th>Desde</th>
                        <th>Por</th>
                        <th>Comentario</th>
                        <th></th>
                    </tr>
                    @foreach ($resource->reports->sortByDesc('created_at') as $report)
                        <tr>
                            <td>{!! $report->reporttype->icon !!}</i></td>
                            <td>{{ $report->reporttype->name }}</td>
                            <td>{{ $report->created_at->subHours(5) }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->comment }}</td>
                            <td>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this report?');">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <span class="card-title">Información del recurso</span>
                </div>
            </div>

            <div class="card-body">
                @if ($message = Session::get('warning'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                <div class="form-group">
                    <strong>Centro:</strong>
                    {{ $resource->center->name }}
                </div>
                <div class="form-group">
                    <strong>Provincia:</strong>
                    {{ $resource->province->name }}
                </div>
                <div class="form-group">
                    <strong>Zona:</strong>
                    {{ $resource->zone->name }}
                </div>
                <div class="form-group">
                    <strong>Institución:</strong>
                    {{ $resource->institution->name }}
                </div>
                <div class="form-group">
                    <strong>Tipo de Recurso:</strong>
                    {{ $resource->resourcetype->name }}
                </div>
                <div class="form-group">
                    <strong>Nombre:</strong>
                    {{ $resource->name }}
                </div>
                <div class="form-group">
                    <strong>Comentario:</strong>
                    {{ $resource->comment }}
                </div>
                <div class="form-group">
                    <strong>Activo:</strong>
                    {{ $resource->is_active ? 'SI' : 'NO' }}
                </div>
                <a class="btn btn-primary" href="{{ route('routes.create', ['resource_id' => $resource->id]) }}">Crear
                    Ruta</a>


            </div>
        </div>


    </section>
@endsection
