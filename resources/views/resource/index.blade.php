@extends('layouts.app')

@section('template_title')
    Resource
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Resource') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('resources.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
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

                                <th>Center</th>
                                <th>Province</th>
                                <th>Zone</th>
                                <th>Institution</th>
                                <th>Resourcetype</th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th>Is Active</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resources->sortByDesc('is_active') as $resource)
                                <tr class="{{ $resource->is_active ? '' : 'table-danger' }}">
                                    <td>{{ $resource->id }}</td>

                                    <td>{{ $resource->center->name }}</td>
                                    <td>{{ $resource->province->name }}</td>
                                    <td>{{ $resource->zone->name }}</td>
                                    <td>{{ $resource->institution->name }}</td>
                                    <td>{{ $resource->resourcetype->name }}</td>
                                    <td>{{ $resource->name }}</td>
                                    <td>{{ $resource->comment }}</td>
                                    <td>{{ $resource->is_active ? 'YES' : 'NO' }}</td>

                                    <td>
                                        <form action="{{ route($resource->is_active ? 'resources.destroy' : 'resources.restore', $resource->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('resources.show', $resource->id) }}"> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('resources.edit', $resource->id) }}"> Edit</a>
                                            @csrf
                                            @method($resource->is_active ? 'DELETE' : 'POST')
                                            <button type="submit" class="btn btn-danger btn-sm"> {{ $resource->is_active ? 'Delete' : 'Restore' }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {!! $resources->links() !!}


            </div>
        </div>
    </div>
@endsection
