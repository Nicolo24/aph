@extends('layouts.app')

@section('template_title')
    {{ $basetype->name ?? 'Show Basetype' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Basetype</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('basetypes.index') }}"> Back</a>
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
