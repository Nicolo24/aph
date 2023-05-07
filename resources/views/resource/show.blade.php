@extends('layouts.app')

@section('template_title')
    {{ $resource->name ?? 'Show Resource' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                Historic of reports
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <th></th>   
                        <th>Report</th>
                        <th>Since</th>
                        <th>By</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                    @foreach ($resource->reports->sortByDesc('created_at') as $report)
                        <tr>
                            <td>{!! $report->reporttype->icon !!}</i></td>
                            <td>{{ $report->reporttype->name }}</td>
                            <td>{{ $report->created_at->subHours(5) }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->comment }}</td>
                            <td>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this report?');">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <span class="card-title">Resource Info</span>
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Center Id:</strong>
                    {{ $resource->center->name }}
                </div>
                <div class="form-group">
                    <strong>Province Id:</strong>
                    {{ $resource->province->name }}
                </div>
                <div class="form-group">
                    <strong>Zone Id:</strong>
                    {{ $resource->zone->name }}
                </div>
                <div class="form-group">
                    <strong>Institution Id:</strong>
                    {{ $resource->institution->name }}
                </div>
                <div class="form-group">
                    <strong>Resourcetype Id:</strong>
                    {{ $resource->resourcetype->name }}
                </div>
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $resource->name }}
                </div>
                <div class="form-group">
                    <strong>Comment:</strong>
                    {{ $resource->comment }}
                </div>
                <div class="form-group">
                    <strong>Is Active:</strong>
                    {{ $resource->is_active ? 'YES' : 'NO' }}
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
