@extends('layouts.app')

@section('template_title')
    {{ $assignation->name ?? 'Show Assignation' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Assignation</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('assignations.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Resource Id:</strong>
                            {{ $assignation->resource_id }}
                        </div>
                        <div class="form-group">
                            <strong>Base Id:</strong>
                            {{ $assignation->base_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $assignation->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Is Active:</strong>
                            {{ $assignation->is_active }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
