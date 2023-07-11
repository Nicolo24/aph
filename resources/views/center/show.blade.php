@extends('layouts.app')

@section('template_title')
    {{ $center->name ?? 'Show Center' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <span class="card-title">Show Center</span>
                </div>
                <div class="float-end">
                    {{-- <a class="btn btn-primary" href="{{ route('centers.index') }}"> Back</a> --}}
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Nombre:</strong>
                    {{ $center->name }}
                </div>

                <div class="form-group">

                    center's bases table
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>

                                    <th>Centro</th>
                                    <th>Provincia</th>
                                    <th>Zona</th>
                                    <th>Institución</th>
                                    <th>Tipo de base</th>
                                    <th>Nombre</th>
                                    <th>Comentario</th>
                                    <th>Activo</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($center->bases as $base)
                                    <tr>
                                        <td>{{ $base->id }}</td>

                                        <td>{{ $base->center->name }}</td>
                                        <td>{{ $base->province->name }}</td>
                                        <td>{{ $base->zone->name }}</td>
                                        <td>{{ $base->institution->name }}</td>
                                        <td>{{ $base->basetype->name }}</td>
                                        <td><a target="_blank" href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a></td>
                                        <td>{{ $base->comment }}</td>
                                        <td>{{ $base->is_active ? 'SI' : 'NO' }}</td>

                                        <td>
                                            <form action="{{ route('bases.destroy', $base->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('bases.show', $base->id) }}">Show</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('bases.edit', $base->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    center's resources table

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>

                                    <th>Centro</th>
                                    <th>Provincia</th>
                                    <th>Zona</th>
                                    <th>Institución</th>
                                    <th>Tipo de recurso</th>
                                    <th>Nombre</th>
                                    <th>Comentario</th>
                                    <th>Activo</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($center->resources as $resource)
                                    <tr>
                                        <td>{{ $resource->id }}</td>
                                        
                                        <td>{{ $resource->center->name }}</td>
                                        <td>{{ $resource->province->name }}</td>
                                        <td>{{ $resource->zone->name }}</td>
                                        <td>{{ $resource->institution->name }}</td>
                                        <td>{{ $resource->resourcetype->name }}</td>
                                        <td><a target="_blank" href="{{ route('resources.show', $resource->id) }}">{{ $resource->name }}</a></td>
                                        <td>{{ $resource->comment }}</td>
                                        <td>{{ $resource->is_active?"SI":"NO" }}</td>

                                        <td>
                                            <form action="{{ route('resources.destroy',$resource->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('resources.show',$resource->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('resources.edit',$resource->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                </div>
            </div>
        </div>
    </section>
@endsection
