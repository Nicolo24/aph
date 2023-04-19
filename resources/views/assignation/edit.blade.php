@extends('layouts.app')

@section('template_title')
    Update Assignation
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Assignation</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('assignations.update', $assignation->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('assignation.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
