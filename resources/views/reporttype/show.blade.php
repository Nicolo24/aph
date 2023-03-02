@extends('layouts.app')

@section('template_title')
    {{ $reporttype->name ?? 'Show Reporttype' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Reporttype</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reporttypes.index') }}"> Back</a>
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
