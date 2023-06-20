@extends('layouts.app')

@section('template_title')
    Create Route
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Route</span>
                    </div>
                    <div class="card-body">

                        @if ($warning??false)
                            <div class="alert alert-warning">
                                <p>{{ $warning }}</p>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('routes.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('route.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
