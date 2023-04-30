@extends('layouts.app')

@section('template_title')
    {{ $base->name ?? 'Show Base' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <span class="card-title">Show Base</span>
                </div>
                <div class="float-end">
                    {{-- <a class="btn btn-primary" href="{{ route('bases.index') }}"> Back</a> --}}
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Center Id:</strong>
                    {{ $base->center->name }}
                </div>
                <div class="form-group">
                    <strong>Province Id:</strong>
                    {{ $base->province->name }}
                </div>
                <div class="form-group">
                    <strong>Zone Id:</strong>
                    {{ $base->zone->name }}
                </div>
                <div class="form-group">
                    <strong>Institution Id:</strong>
                    {{ $base->institution->name }}
                </div>
                <div class="form-group">
                    <strong>Basetype Id:</strong>
                    {{ $base->basetype->name }}
                </div>
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $base->name }}
                </div>
                <div class="form-group">
                    <strong>Latitude:</strong>
                    {{ $base->latitude }}
                </div>
                <div class="form-group">
                    <strong>Longitude:</strong>
                    {{ $base->longitude }}
                </div>
                <div class="form-group">
                    <strong>Comment:</strong>
                    {{ $base->comment }}
                </div>
                <div class="form-group">
                    <strong>Is Active:</strong>
                    {{ $base->is_active ? 'YES' : 'NO' }}
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
