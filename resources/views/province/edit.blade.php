@extends('layouts.app')

@section('template_title')
    Update Province
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Province</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('provinces.update', $province->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('province.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
