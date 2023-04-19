@extends('layouts.app')

@section('template_title')
    Update Reporttype
@endsection

@section('content')
    <div class="d-flex justify-content-center">

        @includeif('partials.errors')

        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Update Reporttype</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reporttypes.update', $reporttype->id) }}" role="form"
                    enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    @include('reporttype.form')

                </form>
            </div>
        </div>
    </div>
    </div>
    </section>
@endsection
