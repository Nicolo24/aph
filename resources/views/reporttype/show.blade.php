@extends('layouts.app')

@section('template_title')
    {{ $reporttype->name ?? 'Show Reporttype' }}
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <span class="card-title">Show Reporttype</span>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('classifications.index') }}"> Back</a>
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $reporttype->name }}
                </div>
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $reporttype->description }}
                </div>
                <div class="form-group">
                    <strong>Is Operative:</strong>
                    {{ $reporttype->is_operative }}
                </div>

            </div>
        </div>
    </div>
    </div>
    </section>
@endsection
