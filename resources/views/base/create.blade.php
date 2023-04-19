@extends('layouts.app')

@section('template_title')
    Create Base
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Base</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bases.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('base.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
