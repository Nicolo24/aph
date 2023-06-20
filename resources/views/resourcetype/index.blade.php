@extends('layouts.app')

@section('template_title')
    Resourcetype
@endsection

@section('content')
    <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo de recurso') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('resourcetypes.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
                                  {{ __('Crear nuevo') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>
                        {{ $message }}
                    </div>
                </div>
            @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        
										<th>Nombre</th>
										<th>Descripción</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resourcetypes as $resourcetype)
                                        <tr>
                                            <td>{{ $resourcetype->id }}</td>
                                            
											<td>{{ $resourcetype->name }}</td>
											<td>{{ $resourcetype->description }}</td>

                                            <td>
                                                <form action="{{ route('resourcetypes.destroy',$resourcetype->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('resourcetypes.show',$resourcetype->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('resourcetypes.edit',$resourcetype->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $resourcetypes->links() !!}
            </div>
        </div>
    </div>
@endsection
