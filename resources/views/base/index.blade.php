@extends('layouts.app')

@section('template_title')
    Base
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Base') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('bases.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
                            {{ __('Crear nuevo') }}
                        </a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>
                        {{ $message }}
                    </div>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>ID</th>

                                <th>Centro</th>
                                <th>Provincia</th>
                                <th>Zona</th>
                                <th>Institución</th>
                                <th>Tipo</th>
                                <th>Nombre</th>
                                <th>Comentario</th>
                                <th>Activo</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->bases->sortByDesc('is_active') as $base)
                                <tr class="{{ $base->is_active ? '' : 'table-danger' }}">
                                    <td>{{ $base->id }}</td>

                                    <td>{{ $base->center->name }}</td>
                                    <td>{{ $base->province->name }}</td>
                                    <td>{{ $base->zone->name }}</td>
                                    <td>{{ $base->institution->name }}</td>
                                    <td>{{ $base->basetype->name }}</td>
                                    <td>{{ $base->name }}</td>
                                    <td>{{ $base->comment }}</td>
                                    <td>{{ $base->is_active ? 'SI' : 'NO' }}</td>

                                    <td>
                                        <form action="{{ $base->is_active ? route('bases.destroy', $base->id) : route('bases.restore', $base->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('bases.show', $base->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('bases.edit', $base->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method($base->is_active ? 'DELETE' : 'POST')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-solid {{ $base->is_active ? 'fa-trash-can' : 'fa-trash-can-arrow-up' }}"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-center">
                {!! $bases->links() !!}


            </div>
        </div>
    </div>
@endsection
