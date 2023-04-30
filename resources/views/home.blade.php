@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center p-3 my-3 text-white bg-secondary rounded shadow-sm">
        <i class="fa-solid fa-truck-medical" style="font-size: 2.5em;"></i>
        <div class="lh-1 px-3">
            <h1 class="h6 mb-0 text-white lh-1">{{ Auth::user()->usertype->name }}</h1>
            <small>{{ Auth::user()->institution->name }} - {{ Auth::user()->zone->name }}</small>
        </div>
    </div>



    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="card col-md align-self-stretch">
            <div class="card-header">
                Map with markers
            </div>
            <div class="card-body h-100" id="map-container">
                <div id="map" style="height: 100%;"></div>
                <script>
                    function initMap() {
                      const locations = [
                        @foreach ($bases as $base)
                          {
                            lat: {{ $base->latitude }},
                            lng: {{ $base->longitude }},
                            title: "{{ $base->name }}",
                            isOperative: {{ $base->is_operative ? 'true' : 'false' }},
                          },
                        @endforeach
                      ];
                  
                      const operativeIcon = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png';
                      const nonOperativeIcon = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
                  
                      const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 6,
                      });
                  
                      const infowindow = new google.maps.InfoWindow();
                      const bounds = new google.maps.LatLngBounds();
                  
                      for (let i = 0; i < locations.length; i++) {
                        const marker = new google.maps.Marker({
                          position: locations[i],
                          title: locations[i].title,
                          icon: locations[i].isOperative ? operativeIcon : nonOperativeIcon,
                          map: map,
                        });
                  
                        bounds.extend(marker.getPosition());
                  
                        marker.addListener("click", () => {
                          infowindow.setContent(`${locations[i].title}`);
                          infowindow.open(map, marker);
                        });
                      }
                  
                      map.fitBounds(bounds);
                    }
                  </script>

                <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>

            </div>
        </div>

        <div class="card shadow-sm col-md-auto">
            <div class="card-header">
                Bases
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                @foreach ($bases as $base)
                    <div class="card mb-2">
                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item me-auto">
                                    {{ $base->icon }} <a target="_blank" class="fw-bold" href="{{ route('bases.show', $base->id) }}">{{ $base->name }}</a>
                                </li>
                                <li class="nav-item ms-auto">
                                    <form action="{{ route('assign') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="base_id" value="{{ $base->id }}">
                                        <select class="form-select form-select-sm" name="resource_id" id="resource_id" onchange="form.submit()">
                                            <option value="0">Select Resource</option>
                                            @foreach ($base->available_resources as $resource)
                                                <option value="{{ $resource->id }}">{{ $resource->icon }} {{ $resource->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Resource</th>
                                        <th scope="col">Assigned By</th>
                                        <th scope="col">Since</th>
                                        <th scope="col" class=" text-end"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($base->assigned_resources as $assignation)
                                        <tr>

                                            <td class="dropdown align-middle">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                                    title="{{ $assignation->resource->last_report->created_at->subHours(5) ?? '' }} - {{ $assignation->resource->last_report->comment ?? '' }}">
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
                                            <td class="align-middle"><a target="_blank" href="{{ route('resources.show', $assignation->resource->id) }}">{{ $assignation->resource->name }}</a></td>
                                            <td class="align-middle">{{ $assignation->user->name }}</td>
                                            <td class="align-middle">{{ $assignation->created_at->subHours(5) }}</td>




                                            <form action="{{ route('unassign') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="assignation_id" value="{{ $assignation->id }}">
                                                <td class="align-middle text-end">
                                                    <button type="submit" class="btn btn-link">
                                                        <i class="fa-solid fa-xmark fa-2xl" style="color: #ff0000;"></i>
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
