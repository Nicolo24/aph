@extends('layouts.app')

@section('template_title')
    Create Assignation
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Asignación</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('assignations.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('assignation.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
