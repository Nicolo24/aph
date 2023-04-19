@extends('layouts.app')

@section('template_title')
    Create Basetype
@endsection

@section('content')
    <section class="d-flex justify-content-center">


        @includeif('partials.errors')

        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Create Basetype</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('basetypes.store') }}" role="form" enctype="multipart/form-data">
                    @csrf

                    @include('basetype.form')

                </form>
            </div>
        </div>
    </section>
@endsection
