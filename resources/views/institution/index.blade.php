@extends('layouts.app')

@section('template_title')
    Institution
@endsection

@section('content')
    <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Institution') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('institutions.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
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
                                        <th>ID</th>
                                        
										<th>Name</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($institutions as $institution)
                                        <tr>
                                            <td>{{ $institution->id }}</td>
                                            
											<td>{{ $institution->name }}</td>

                                            <td>
                                                <form action="{{ route('institutions.destroy',$institution->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('institutions.show',$institution->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('institutions.edit',$institution->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $institutions->links() !!}
            </div>
        </div>
    </div>
@endsection
