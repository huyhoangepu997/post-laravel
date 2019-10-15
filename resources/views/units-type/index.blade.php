@extends('layouts.unit')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('units-type.create') }}" class="btn btn-success">
            Create Unit Type
        </a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Units Type
        </div>
        <div class="card-body">
            @if(count($unitsType))
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th></th>
                        <th>Action</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($unitsType as $unitType)
                            <tr>
                                <td>{{ $unitType->name }}</td>
                                <td></td>
                                <td width="10%">
                                    <a href="{{ route('units-type.edit', $unitType->id) }}" class="btn btn-info btn-sm">Edit</a>
                                </td>
                                <td width="10%">
                                    <form action="{{ route('units-type.destroy', $unitType->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
