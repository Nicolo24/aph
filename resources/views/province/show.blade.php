@extends('layouts.app')

@section('template_title')
    {{ $province->name ?? 'Show Province' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Province</span>
                        </div>
                        <div class="float-end">
                            {{-- <a class="btn btn-primary" href="{{ route('provinces.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $province->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
