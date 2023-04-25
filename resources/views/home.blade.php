@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center p-3 my-3 text-white bg-secondary rounded shadow-sm">
        <i class="fa-solid fa-truck-medical" style="font-size: 2.5em;"></i>
        <div class="lh-1 px-3">
            <h1 class="h6 mb-0 text-white lh-1">{{Auth::user()->usertype->name}}</h1>
            <small>{{ Auth::user()->institution->name }} - {{ Auth::user()->zone->name }}</small>
        </div>
    </div>




    <div class="card">

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Resource</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bases as $base)
                        <tr>
                            <td>{{ $base->icon }}</td>
                            <td><a target="_blank" href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a></td>

                            <form action="{{ route('assign') }}" method="post">
                                @csrf
                                <input type="hidden" name="base_id" value="{{ $base->id }}">
                                <td>
                                    <select name="resource_id" id="resource_id" onchange="form.submit()">
                                        <option value="0">Select Resource</option>
                                        @foreach ($base->available_resources as $resource)
                                            <option value="{{ $resource->id }}">{{ $resource->icon }} {{ $resource->name }}</option>
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
                                                    <th scope="col">Assigned At</th>
                                                    <th scope="col">Unassign</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($base->assigned_resources as $assignation)
                                                    <tr>

                                                        <td class="dropdown">
                                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                                {{ $assignation->resource->icon }}
                                                            </a>
                                                            <form action="{{ route('report') }}" method="post">
                                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                                    <div class="dropdown-item" href="#">

                                                                        @csrf
                                                                        <input type="hidden" name="resource_id" value="{{ $assignation->resource->id }}">
                                                                        @foreach (\App\Models\Reporttype::all() as $reporttype)
                                                                            <div class="form-group">

                                                                                {{ Form::radio('reporttype_id', $reporttype->id, $assignation->resource->reporttype_id == $reporttype->id, ['id' => 'reporttype_id']) }}
                                                                                {{ Form::label('reporttype_id', $reporttype->name) }}
                                                                            </div>
                                                                        @endforeach
                                                                        <div class="form-group mt-2">

                                                                            {{ Form::textarea('comment', '', ['class' => 'form-control']) }}
                                                                        </div>
                                                                        <div class="form-group">

                                                                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td><a target="_blank" href="{{ route('resources.show', $assignation->resource->id) }}">{{ $assignation->resource->name }}</a></td>
                                                        <td>{{ $assignation->user->name }}</td>
                                                        <td>{{ $assignation->created_at->subHours(5) }}</td>




                                                        <form action="{{ route('unassign') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="assignation_id" value="{{ $assignation->id }}">
                                                            <td>
                                                                <button type="submit" class="btn btn-primary">Unassign</button>
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
@endsection
