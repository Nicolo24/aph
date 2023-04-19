@extends('layouts.app')

@section('template_title')
    Base
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Base') }}
                    </span>

                    <div class="float-end">
                        <a href="{{ route('bases.create') }}" class="btn btn-primary btn-sm float-end" data-placement="left">
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
                                <th>Basetype</th>
                                <th>Name</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Comment</th>
                                <th>Is Active</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bases->sortByDesc('is_active') as $base)
                                <tr class="{{ $base->is_active ? '' : 'table-danger' }}">
                                    <td>{{ $base->id }}</td>

                                    <td>{{ $base->center->name }}</td>
                                    <td>{{ $base->province->name }}</td>
                                    <td>{{ $base->zone->name }}</td>
                                    <td>{{ $base->institution->name }}</td>
                                    <td>{{ $base->basetype->name }}</td>
                                    <td>{{ $base->name }}</td>
                                    <td>{{ $base->latitude }}</td>
                                    <td>{{ $base->longitude }}</td>
                                    <td>{{ $base->comment }}</td>
                                    <td>{{ $base->is_active ? 'YES' : 'NO' }}</td>

                                    <td>
                                        <form action="{{ $base->is_active ? route('bases.destroy', $base->id) : route('bases.restore', $base->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('bases.show', $base->id) }}"> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('bases.edit', $base->id) }}"> Edit</a>
                                            @csrf
                                            @method($base->is_active ? 'DELETE' : 'POST')
                                            <button type="submit" class="btn btn-danger btn-sm">{{ $base->is_active ? 'Delete' : 'Restore' }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-center">
                {!! $bases->links() !!}


            </div>
        </div>
    </div>
@endsection
