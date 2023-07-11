@extends('layouts.app')

@section('template_title')
    Create Resource
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Recurso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('resource.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
