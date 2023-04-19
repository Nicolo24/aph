@extends('layouts.app')

@section('template_title')
    Update Resource
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Resource</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.update', $resource->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('resource.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
