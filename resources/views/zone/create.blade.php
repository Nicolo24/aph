@extends('layouts.app')

@section('template_title')
    Create Zone
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Zone</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('zones.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('zone.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
