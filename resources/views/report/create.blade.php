@extends('layouts.app')

@section('template_title')
    Create Report
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Report</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('reports.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('report.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
