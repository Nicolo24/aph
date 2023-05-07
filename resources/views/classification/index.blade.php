@extends('layouts.app')

@section('template_title')
    Resourcetype
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5 m-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Resourcetype') }}
                            </span>

                            <div class="float-end">
                                <a href="{{ route('resourcetypes.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('resourcetypesuccess'))
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
                                    @foreach ($resourcetypes as $resourcetype)
                                        <tr>
                                            <td>{{ $resourcetype->id }}</td>

                                            <td>{{ $resourcetype->name }}</td>
                                            <td>{{ $resourcetype->description }}</td>

                                            <td>
                                                <form action="{{ route('resourcetypes.destroy', $resourcetype->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('resourcetypes.show', $resourcetype->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('resourcetypes.edit', $resourcetype->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
            </div>
            <div class="col-5 m-2">
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
                    @if ($message = Session::get('usertypesuccess'))
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
                                                    <a class="btn btn-sm btn-primary " href="{{ route('usertypes.show', $usertype->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('usertypes.edit', $usertype->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
            </div>

            <div class="col-5 m-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Basetype') }}
                            </span>

                            <div class="float-end">
                                <a href="{{ route('basetypes.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('basetypesuccess'))
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
                                                    <a class="btn btn-sm btn-primary " href="{{ route('basetypes.show', $basetype->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('basetypes.edit', $basetype->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 m-2">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reporttype') }}
                            </span>

                            <div class="float-end">
                                <a href="{{ route('reporttypes.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('reporttypesuccess'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Is Operative</th>
                                        <th>Icon</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reporttypes as $reporttype)
                                        <tr>
                                            <td>{{ $reporttype->name }}</td>
                                            <td>{{ $reporttype->description }}</td>
                                            <td>{{ $reporttype->is_operative ? 'YES' : 'NO' }}</td>
                                            <td>{!! $reporttype->icon !!}</td>

                                            <td>
                                                <form action="{{ route('reporttypes.destroy', $reporttype->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reporttypes.show', $reporttype->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reporttypes.edit', $reporttype->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
