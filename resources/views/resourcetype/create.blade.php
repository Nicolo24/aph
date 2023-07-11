@extends('layouts.app')

@section('template_title')
    Create Resourcetype
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Tipo de recurso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resourcetypes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('resourcetype.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
