@extends('layouts.app')

@section('template_title')
    Reporttype
@endsection

@section('content')
    <div class="d-flex justify-content-center">

        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Tipo de reporte') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('reporttypes.create') }}" class="btn btn-primary btn-sm float-end"
                            data-placement="left">
                            {{ __('Crear nuevo') }}
                        </a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Operativo</th>
                                <th>En Emergencia</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reporttypes as $reporttype)
                                <tr>
                                    <td>{{ $reporttype->name }}</td>
                                    <td>{{ $reporttype->description }}</td>
                                    <td>{{ $reporttype->is_operative?'SI':'NO' }}</td>
                                    <td>{{ $reporttype->in_emergency?'SI':'NO'}}</td>

                                    <td>
                                        <form action="{{ route('reporttypes.destroy', $reporttype->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('reporttypes.show', $reporttype->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('reporttypes.edit', $reporttype->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $reporttypes->links() !!}
    </div>
@endsection
