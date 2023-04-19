@extends('layouts.app')

@section('template_title')
    Center
@endsection

@section('content')
    <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Center') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('centers.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
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
                                    @foreach ($centers as $center)
                                        <tr>
                                            <td>{{ $center->id }}</td>
                                            
											<td>{{ $center->name }}</td>

                                            <td>
                                                <form action="{{ route('centers.destroy',$center->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('centers.show',$center->id) }}"> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('centers.edit',$center->id) }}"> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $centers->links() !!}
            </div>
        </div>
    </div>
@endsection
