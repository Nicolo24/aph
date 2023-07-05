@extends('layouts.app')

@section('template_title')
    Location
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ubicación') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('locations.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo') }}
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
                                        <th>No</th>
                                        
										<th>Route</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th>Timestamp</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $location->route_id }}</td>
											<td>{{ $location->latitude }}</td>
											<td>{{ $location->longitude }}</td>
											<td>{{ $location->timestamp }}</td>

                                            <td>
                                                <form action="{{ route('locations.destroy',$location->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('locations.show',$location->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('locations.edit',$location->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                </div>
                {!! $locations->links() !!}
            </div>
        </div>
    </div>
@endsection
