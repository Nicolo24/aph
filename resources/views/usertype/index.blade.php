@extends('layouts.app')

@section('template_title')
    Usertype
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Usertype') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('usertypes.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
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
                                <th>Description</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usertypes as $usertype)
                                <tr>
                                    <td>{{ $usertype->id }}</td>

                                    <td>{{ $usertype->name }}</td>
                                    <td>{{ $usertype->description }}</td>

                                    <td>
                                        <form action="{{ route('usertypes.destroy', $usertype->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('usertypes.show', $usertype->id) }}"> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('usertypes.edit', $usertype->id) }}"> Edit</a>
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
        {!! $usertypes->links() !!}
    </div>
    </div>
    </div>
@endsection
