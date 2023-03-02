@extends('layouts.app')

@section('template_title')
    Assignation
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Assignation') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('assignations.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Resource Id</th>
										<th>Base Id</th>
										<th>User Id</th>
										<th>Is Active</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignations as $assignation)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $assignation->resource_id }}</td>
											<td>{{ $assignation->base_id }}</td>
											<td>{{ $assignation->user_id }}</td>
											<td>{{ $assignation->is_active }}</td>

                                            <td>
                                                <form action="{{ route('assignations.destroy',$assignation->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('assignations.show',$assignation->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('assignations.edit',$assignation->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $assignations->links() !!}
            </div>
        </div>
    </div>
@endsection
