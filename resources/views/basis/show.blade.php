@extends('layouts.app')

@section('template_title')
    {{ $basis->name ?? 'Show Basis' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Basis</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bases.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Center Id:</strong>
                            {{ $basis->center_id }}
                        </div>
                        <div class="form-group">
                            <strong>Province Id:</strong>
                            {{ $basis->province_id }}
                        </div>
                        <div class="form-group">
                            <strong>Zone Id:</strong>
                            {{ $basis->zone_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institution Id:</strong>
                            {{ $basis->institution_id }}
                        </div>
                        <div class="form-group">
                            <strong>Basetype Id:</strong>
                            {{ $basis->basetype_id }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $basis->name }}
                        </div>
                        <div class="form-group">
                            <strong>Latitude:</strong>
                            {{ $basis->latitude }}
                        </div>
                        <div class="form-group">
                            <strong>Longitude:</strong>
                            {{ $basis->longitude }}
                        </div>
                        <div class="form-group">
                            <strong>Comment:</strong>
                            {{ $basis->comment }}
                        </div>
                        <div class="form-group">
                            <strong>Is Active:</strong>
                            {{ $basis->is_active }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
