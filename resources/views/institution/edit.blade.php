@extends('layouts.app')

@section('template_title')
    Update Institution
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Institution</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('institutions.update', $institution->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('institution.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
