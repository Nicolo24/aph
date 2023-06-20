@extends('layouts.app')

@section('template_title')
    {{ $location->name ?? 'Show Location' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Location</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('locations.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Route:</strong>
                            {{ $location->route_id }}
                        </div>
                        <div class="form-group">
                            <strong>Latitude:</strong>
                            {{ $location->latitude }}
                        </div>
                        <div class="form-group">
                            <strong>Longitude:</strong>
                            {{ $location->longitude }}
                        </div>
                        <div class="form-group">
                            <strong>Timestamp:</strong>
                            {{ $location->timestamp }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
