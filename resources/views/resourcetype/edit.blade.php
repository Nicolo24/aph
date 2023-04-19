@extends('layouts.app')

@section('template_title')
    Update Resourcetype
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Resourcetype</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resourcetypes.update', $resourcetype->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('resourcetype.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
