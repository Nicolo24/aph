@extends('layouts.app')

@section('template_title')
    Update Usertype
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Usertype</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usertypes.update', $usertype->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('usertype.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
