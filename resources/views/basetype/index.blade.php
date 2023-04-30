@extends('layouts.app')

@section('template_title')
    Basetype
@endsection

@section('content')
    <div class="d-flex justify-content-center">

        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Basetype') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('basetypes.create') }}" class="btn btn-primary btn-sm float-end"
                            data-placement="left">
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
                            @foreach ($basetypes as $basetype)
                                <tr>
                                    <td>{{ $basetype->id }}</td>

                                    <td>{{ $basetype->name }}</td>
                                    <td>{{ $basetype->description }}</td>

                                    <td>
                                        <form action="{{ route('basetypes.destroy', $basetype->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('basetypes.show', $basetype->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('basetypes.edit', $basetype->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $basetypes->links() !!}
    </div>
    </div>
    </div>
@endsection
