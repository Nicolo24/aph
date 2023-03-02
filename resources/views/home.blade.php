@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('Welcome, ') }}{{ Auth::user()->name }}{{ __('!') }}

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bases as $base)
                            <tr>
                                <td>{{ $base->icon }}</td>
                                <td>{{ $base->name }}</td>

                                <form action="{{ route('assign') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="base_id" value="{{ $base->id }}">
                                    <td>
                                        <select name="resource_id" id="resource_id" onchange="form.submit()">
                                            <option value="0">Select Resource</option>
                                            @foreach ($base->available_resources as $resource)
                                                <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </form>

                            </tr>
                            <tr>
                                <td colspan="13">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Resource</th>
                                                        <th scope="col">Assigned By</th>
                                                        <th scope="col">Created At</th>
                                                        <th scope="col">Report Type</th>
                                                        <th scope="col">Comment</th>
                                                        <th scope="col">Save</th>
                                                        <th scope="col">Unassign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($base->assigned_resources as $assignation)
                                                        <tr>

                                                            <td>{{ $assignation->resource->icon }}</td>
                                                            <td>{{ $assignation->resource->name }}</td>
                                                            <td>{{ $assignation->user->name }}</td>
                                                            <td>{{ $assignation->created_at }}</td>
                                                            <form action="{{route('report')}}" method="post">
                                                                <td>
                                                                    @csrf
                                                                    <input type="hidden" name="resource_id"
                                                                        value="{{ $assignation->resource->id }}">
                                                                    <select name="reporttype_id" id="reporttype_id">
                                                                        @foreach (\App\Models\Reporttype::get() as $reporttype)
                                                                            <option value="{{ $reporttype->id }}" {{ ($reporttype->id == $assignation->resource->reporttype_id) ? 'selected' : '' }}>
                                                                                {{ $reporttype->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    {{ Form::text('comment', '', ['class' => 'form-control']) }}
                                                                <td>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                </td>
                                                            </form>


                                                            <form action="{{ route('unassign') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="assignation_id"
                                                                    value="{{ $assignation->id }}">
                                                                <td>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unassign</button>
                                                                </td>
                                                            </form>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
