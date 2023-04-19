@extends('layouts.app')

@section('template_title')
    Update Base
@endsection

@section('content')
    <section class="d-flex justify-content-center">

        @includeif('partials.errors')

        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Update Base</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bases.update', $base->id) }}" role="form"
                    enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    @include('base.form')

                </form>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
