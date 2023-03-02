@extends('layouts.app')

@section('template_title')
    {{ $resource->name ?? 'Show Resource' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Resource</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('resources.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Center Id:</strong>
                            {{ $resource->center_id }}
                        </div>
                        <div class="form-group">
                            <strong>Province Id:</strong>
                            {{ $resource->province_id }}
                        </div>
                        <div class="form-group">
                            <strong>Zone Id:</strong>
                            {{ $resource->zone_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institution Id:</strong>
                            {{ $resource->institution_id }}
                        </div>
                        <div class="form-group">
                            <strong>Resourcetype Id:</strong>
                            {{ $resource->resourcetype_id }}
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
                            {{ $resource->is_active }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
