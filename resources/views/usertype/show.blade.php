@extends('layouts.app')

@section('template_title')
    {{ $usertype->name ?? 'Show Usertype' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Usertype</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('usertypes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $usertype->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $usertype->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
