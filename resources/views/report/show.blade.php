@extends('layouts.app')

@section('template_title')
    {{ $report->name ?? 'Show Report' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Report</span>
                        </div>
                        <div class="float-end">
                            {{-- <a class="btn btn-primary" href="{{ route('reports.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Resource Id:</strong>
                            {{ $report->resource->name }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $report->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Reporttype Id:</strong>
                            {{ $report->reporttype->name }}
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
