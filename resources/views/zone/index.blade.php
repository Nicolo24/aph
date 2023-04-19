@extends('layouts.app')

@section('template_title')
    Zone
@endsection

@section('content')
    <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Zone') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('zones.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
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
                                    @foreach ($zones as $zone)
                                        <tr>
                                            <td>{{ $zone->id }}</td>
                                            
											<td>{{ $zone->name }}</td>

                                            <td>
                                                <form action="{{ route('zones.destroy',$zone->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('zones.show',$zone->id) }}"> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('zones.edit',$zone->id) }}"> Edit</a>
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
                {!! $zones->links() !!}
            </div>
        </div>
    </div>
@endsection
