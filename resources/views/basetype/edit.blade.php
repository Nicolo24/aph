@extends('layouts.app')

@section('template_title')
    Update Basetype
@endsection

@section('content')
    <div class="d-flex justify-content-center">


        @includeif('partials.errors')

        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Tipo de base</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('basetypes.update', $basetype->id) }}" role="form"
                    enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    @include('basetype.form')

                </form>
            </div>
        </div>
    </div>
    </div>
    </section>
@endsection
