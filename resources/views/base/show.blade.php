@extends('layouts.app')

@section('template_title')
    {{ $base->name ?? 'Show Base' }}
@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                Assignation table
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Resource</th>
                            <th>From</th>
                            <th>To</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($base->assignations->sortByDesc('created_at') as $assignation)
                            <tr class="{{ $assignation->is_active ? 'table-success' : '' }}">
                                <td>{{ $assignation->resource->name }}</td>
                                <td>{{ $assignation->created_at->subHours(5) }}</td>
                                <td>{{ !$assignation->is_active ? $assignation->updated_at->subHours(5):'-' }}</td>
                                <td>
                                    <form action="{{ route('assignations.destroy', $assignation->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this assignation?');">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                </table>             
            </div>
        </div>

        <div class="card">
            <div class="card-header align-items-middle">
                <div class="float-start me-4">
                    <span class="card-title">{{$base->name}}</span>
                </div>
                <div class="d-flex float-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('bases.edit', $base->id) }}"><i class="fas fa-edit fa-lg fa-fw"></i></a>
                        <form action="{{ route('bases.destroy', $base->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-solid {{ $base->is_active ? 'fa-trash-can' : 'fa-trash-can-arrow-up' }}"></i></button>
                        </form>
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Center Id:</strong>
                    {{ $base->center->name }}
                </div>
                <div class="form-group">
                    <strong>Province Id:</strong>
                    {{ $base->province->name }}
                </div>
                <div class="form-group">
                    <strong>Zone Id:</strong>
                    {{ $base->zone->name }}
                </div>
                <div class="form-group">
                    <strong>Institution Id:</strong>
                    {{ $base->institution->name }}
                </div>
                <div class="form-group">
                    <strong>Basetype Id:</strong>
                    {{ $base->basetype->name }}
                </div>
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $base->name }}
                </div>
                <div class="form-group">
                    <strong>Latitude:</strong>
                    {{ $base->latitude }}
                </div>
                <div class="form-group">
                    <strong>Longitude:</strong>
                    {{ $base->longitude }}
                </div>
                <div class="form-group">
                    <strong>Comment:</strong>
                    {{ $base->comment }}
                </div>
                <div class="form-group">
                    <strong>Is Active:</strong>
                    {{ $base->is_active ? 'YES' : 'NO' }}
                </div>
                    


            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
