@extends('layouts.app')

@section('template_title')
    Basis
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Basis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('bases.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Basetype Id</th>
										<th>Name</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th>Comment</th>
										<th>Is Active</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bases as $basis)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $basis->center_id }}</td>
											<td>{{ $basis->province_id }}</td>
											<td>{{ $basis->zone_id }}</td>
											<td>{{ $basis->institution_id }}</td>
											<td>{{ $basis->basetype_id }}</td>
											<td>{{ $basis->name }}</td>
											<td>{{ $basis->latitude }}</td>
											<td>{{ $basis->longitude }}</td>
											<td>{{ $basis->comment }}</td>
											<td>{{ $basis->is_active }}</td>

                                            <td>
                                                <form action="{{ route('bases.destroy',$basis->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('bases.show',$basis->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('bases.edit',$basis->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $bases->links() !!}
            </div>
        </div>
    </div>
@endsection
