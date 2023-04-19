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






                <main class="container py-4">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('historic') }}" method="GET">

                                <h2>Historico de ambulancias</h2>
                                <div class="form-inline">
                                    <div class="form-group mr-3">
                                        <label for="datepicker">Date:</label>
                                        <div class="input-group mt-2">
                                            <input class="form-control border-end-0 border rounded-pill" type="text" value="{{ $local_when = $when->copy()->subHours(5) }}" id="txtwhen" name="when">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button" id="dtnow">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </span>
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="submit">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>

                                            <script>
                                                document.getElementById('dtnow').addEventListener('click', function() {
                                                    document.getElementById('txtwhen').value = "{{ \Carbon\Carbon::now()->subHours(5) }}";
                                                });
                                            </script>



                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <label class="dropdown-toggle mt-2" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Filters:</label>
                                        <div class="dropdown-menu">

                                            <div class="dropdown-item mt-2">
                                                <div class="input-group">
                                                    <div>

                                                        <div class="card">
                                                            <div class="card-header">
                                                                Provinces
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                @foreach (App\Models\Province::get() as $province)
                                                                    <li class="list-group-item">
                                                                        <div class='form-check'>
                                                                            <input class='form-check-input' type='checkbox' value='{{ $province->id }}' id='flexCheckDefault' name='province_id[]'
                                                                                {{ !array_key_exists('province_id', $request) ? 'checked' : (in_array($province->id, $request['province_id']) ? 'checked' : '') }}>
                                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                                                {{ $province->name }}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Centers
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                @foreach (App\Models\Center::get() as $center)
                                                                    <li class="list-group-item">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="{{ $center->id }}" id="flexCheckDefault" name="center_id[]"
                                                                                {{ !array_key_exists('center_id', $request) ? 'checked' : (in_array($center->id, $request['center_id']) ? 'checked' : '') }}>
                                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                                {{ $center->name }} </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Zones
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                @foreach (App\Models\Zone::get() as $zone)
                                                                    <li class="list-group-item">
                                                                        <div class='form-check'>
                                                                            <input class='form-check-input' type='checkbox' value='{{ $zone->id }}' id='flexCheckDefault' name='zone_id[]'
                                                                                {{ !array_key_exists('zone_id', $request) ? 'checked' : (in_array($zone->id, $request['zone_id']) ? 'checked' : '') }}>
                                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                                                {{ $zone->name }}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                Institutions
                                                            </div>
                                                            <ul class="list-group list-group-flush">
                                                                @foreach (App\Models\Institution::get() as $institution)
                                                                    <li class="list-group-item">
                                                                        <div class='form-check'>
                                                                            <input class='form-check-input' type='checkbox' value='{{ $institution->id }}' id='flexCheckDefault' name='institution_id[]'
                                                                                {{ !array_key_exists('institution_id', $request) ? 'checked' : (in_array($institution->id, $request['institution_id']) ? 'checked' : '') }}>
                                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                                                {{ $institution->name }}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </main>
                </table>

                <div class="divider py-1 bg-secondary"></div>



                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Province</th>
                            <th scope="col">Center</th>
                            <th scope="col">Zone</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Since</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resources as $resource)
                            <tr>
                                <th scope="row">{{ $resource->getWasOperativeIconAttribute($when) }}</th>
                                <td>{{ $resource->province->name }}</td>
                                <td>{{ $resource->center->name }}</td>
                                <td>{{ $resource->zone->name }}</td>
                                <td>{{ $resource->institution->name }}</td>
                                <td><a target="_blank" href="{{ route('resources.show', $resource->id) }}">{{ $resource->name }}</a></td>
                                <td>{{ $resource->description }}</td>
                                <td>{{ $resource->getWasReportedAttribute($when) ? $resource->getWasReportedAttribute($when)->created_at->subHours(5) : '-' }}</td>
                                <td>{{ $resource->getWasReportedAttribute($when)->comment ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </form>

            </div>

        </div>
    @endsection
