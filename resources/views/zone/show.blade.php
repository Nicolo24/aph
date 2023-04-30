@extends('layouts.app')

@section('template_title')
    {{ $zone->name ?? 'Show Zone' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">Show Zone</span>
                        </div>
                        <div class="float-end">
                            {{-- <a class="btn btn-primary" href="{{ route('zones.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $zone->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
