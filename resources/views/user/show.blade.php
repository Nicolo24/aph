@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? 'Show User' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show User</span>
                        </div>
                        <div class="float-end">
                            {{-- <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Centro:</strong>
                            {{ $user->center->name }}
                        </div>
                        <div class="form-group">
                            <strong>Provincia:</strong>
                            {{ $user->province->name }}
                        </div>
                        <div class="form-group">
                            <strong>Zona:</strong>
                            {{ $user->zone->name }}
                        </div>
                        <div class="form-group">
                            <strong>Institución:</strong>
                            {{ $user->institution->name }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de usuario:</strong>
                            {{ $user->usertype->name }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
