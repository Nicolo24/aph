@extends('layouts.app')

@section('template_title')
    {{ $report->name ?? 'Show Report' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Report</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reports.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Resource Id:</strong>
                            {{ $report->resource_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $report->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Reporttype Id:</strong>
                            {{ $report->reporttype_id }}
                        </div>
                        <div class="form-group">
                            <strong>Comment:</strong>
                            {{ $report->comment }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
