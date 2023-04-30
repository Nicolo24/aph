@extends('layouts.app')

@section('template_title')
    Province
@endsection

@section('content')
    <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Province') }}
                            </span>

                             <div class="float-end">
                                <a href="{{ route('provinces.create') }}" class="btn btn-primary btn-sm float-end"  data-placement="left">
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
                                    @foreach ($provinces as $province)
                                        <tr>
                                            <td>{{ $province->id }}</td>
                                            
											<td>{{ $province->name }}</td>

                                            <td>
                                                <form action="{{ route('provinces.destroy',$province->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('provinces.show',$province->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('provinces.edit',$province->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $provinces->links() !!}
            </div>
        </div>
    </div>
@endsection
