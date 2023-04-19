@extends('layouts.app')

@section('template_title')
    {{ $resource->name ?? 'Show Resource' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Resource</span>
                        </div>
                        <div class="float-end">
                            <a class="btn btn-primary" href="{{ route('resources.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Center Id:</strong>
                            {{ $resource->center->name }}
                        </div>
                        <div class="form-group">
                            <strong>Province Id:</strong>
                            {{ $resource->province->name }}
                        </div>
                        <div class="form-group">
                            <strong>Zone Id:</strong>
                            {{ $resource->zone->name }}
                        </div>
                        <div class="form-group">
                            <strong>Institution Id:</strong>
                            {{ $resource->institution->name }}
                        </div>
                        <div class="form-group">
                            <strong>Resourcetype Id:</strong>
                            {{ $resource->resourcetype->name }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $resource->name }}
                        </div>
                        <div class="form-group">
                            <strong>Comment:</strong>
                            {{ $resource->comment }}
                        </div>
                        <div class="form-group">
                            <strong>Is Active:</strong>
                            {{ $resource->is_active?"YES":"NO" }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
