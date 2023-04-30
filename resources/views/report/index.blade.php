@extends('layouts.app')

@section('template_title')
    Report
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Report') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('reports.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>ID</th>
                                <th>Reported At</th>
                                <th>Resource</th>
                                <th>User</th>
                                <th>Reporttype</th>
                                <th>Comment</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->created_at->subHours(5) }}</td>
                                    <td><a target="_blank" href="{{ route('resources.show', $report->resource->id) }}">{{ $report->resource->name }}</a></td>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->reporttype->name }}</td>
                                    <td>{{ $report->comment }}</td>

                                    <td>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('reports.show', $report->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success" href="{{ route('reports.edit', $report->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {!! $reports->links() !!}


            </div>
        </div>
    </div>
@endsection
