@extends('layouts.app')

@section('template_title')
    Update Report
@endsection

@section('content')
    <section class="d-flex justify-content-center">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Report</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('reports.update', $report->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('report.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
