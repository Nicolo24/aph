@extends('layouts.app')

@section('template_title')
    {{ $institution->name ?? 'Show Institution' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Institution</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('institutions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $institution->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
