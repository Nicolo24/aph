@extends('layouts.app')

@section('template_title')
    {{ $basetype->name ?? 'Show Basetype' }}
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <span class="card-title">Show Basetype</span>
                </div>
                <div class="float-end">
                    {{-- <a class="btn btn-primary" href="{{ route('classifications.index') }}"> Back</a> --}}
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $basetype->name }}
                </div>
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $basetype->description }}
                </div>

            </div>
        </div>
    </div>
    </div>
    </section>
@endsection
