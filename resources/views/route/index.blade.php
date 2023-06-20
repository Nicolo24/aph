@extends('layouts.app')

@section('template_title')
    Route
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ruta') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('routes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>ID de Recurso</th>
										<th>Usuario</th>
										<th>Start Address</th>
										<th>Emergency Address</th>
										<th>Destination Address</th>
										<th>Start Time</th>
										<th>Pickup Time</th>
										<th>End Time</th>
										<th>Instructions</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routes as $route)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $route->resource_id }}</td>
											<td>{{ $route->user_id }}</td>
											<td>{{ $route->start_address }}</td>
											<td>{{ $route->emergency_address }}</td>
											<td>{{ $route->destination_address }}</td>
											<td>{{ $route->start_time }}</td>
											<td>{{ $route->pickup_time }}</td>
											<td>{{ $route->end_time }}</td>
											<td>{{ $route->instructions }}</td>

                                            <td>
                                                <form action="{{ route('routes.destroy',$route->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('routes.show',$route->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('routes.edit',$route->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $routes->links() !!}
            </div>
        </div>
    </div>
@endsection
