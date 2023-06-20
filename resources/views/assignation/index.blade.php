@extends('layouts.app')

@section('template_title')
    Assignation
@endsection

@section('content')
    <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Asignación') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('assignations.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
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
                                        
										<th>Recurso</th>
										<th>Base</th>
										<th>Usuario</th>
										<th>Activo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignations as $assignation)
                                        <tr>
                                            <td>{{ $assignation->id }}</td>
                                            
											<td><a target="_blank" href="{{ route('resources.show', $assignation->resource->id) }}">{{ $assignation->resource->name }}</a></td>
											<td><a target="_blank" href="{{ route('bases.show', $assignation->base->id) }}">{{ $assignation->base->name }}</a></td>
											<td>{{ $assignation->user->name }}</td>
											<td>{{ $assignation->is_active?"SI":"NO" }}</td>

                                            <td>
                                                <form action="{{ route('assignations.destroy',$assignation->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('assignations.show',$assignation->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('assignations.edit',$assignation->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $assignations->links() !!}
            </div>
        </div>
    </div>
@endsection
