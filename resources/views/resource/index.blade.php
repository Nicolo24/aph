@extends('layouts.app')

@section('template_title')
    Resource
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Resource') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('resources.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
                                        
										<th>Center Id</th>
										<th>Province Id</th>
										<th>Zone Id</th>
										<th>Institution Id</th>
										<th>Resourcetype Id</th>
										<th>Name</th>
										<th>Comment</th>
										<th>Is Active</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $resource->center_id }}</td>
											<td>{{ $resource->province_id }}</td>
											<td>{{ $resource->zone_id }}</td>
											<td>{{ $resource->institution_id }}</td>
											<td>{{ $resource->resourcetype_id }}</td>
											<td>{{ $resource->name }}</td>
											<td>{{ $resource->comment }}</td>
											<td>{{ $resource->is_active }}</td>

                                            <td>
                                                <form action="{{ route('resources.destroy',$resource->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('resources.show',$resource->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('resources.edit',$resource->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $resources->links() !!}
            </div>
        </div>
    </div>
@endsection
