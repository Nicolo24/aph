@extends('layouts.app')

@section('template_title')
    {{ $assignation->name ?? 'Show Assignation' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Assignation</span>
                        </div>
                        <div class="float-end">
                            {{-- <a class="btn btn-primary" href="{{ route('assignations.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>ID de Recurso:</strong>
                            {{ $assignation->resource->name }}
                        </div>
                        <div class="form-group">
                            <strong>Base:</strong>
                            {{ $assignation->base->name }}
                        </div>
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $assignation->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Activo:</strong>
                            {{ $assignation->is_active?"SI":"NO" }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
