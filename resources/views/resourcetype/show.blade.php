@extends('layouts.app')

@section('template_title')
    {{ $resourcetype->name ?? 'Show Resourcetype' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Resourcetype</span>
                        </div>
                        <div class="float-end">
                            {{-- <a class="btn btn-primary" href="{{ route('classifications.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $resourcetype->name }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $resourcetype->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
