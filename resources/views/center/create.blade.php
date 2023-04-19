@extends('layouts.app')

@section('template_title')
    Create Center
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Center</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('centers.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('center.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
