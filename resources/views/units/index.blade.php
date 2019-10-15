@extends('layouts.unit')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('units.create') }}" class="btn btn-success">Create Unit</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Units
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Symbol</th>
                    <th>Default</th>
                    <th>Action</th>
                    <th></th>
                </thead>
                <tbody>
                    @if(count($units))
                        @foreach($units as $unit)
                            <tr>
                                <td>
                                    {{ $unit->name }}
                                </td>
                                <td>
                                    {{ $unit->unitType->name ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->symbol }}
                                </td>
                                <td>
                                    {{ $unit->default }}
                                </td>
                                <td width="10%">
                                    <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-info btn-sm">Edit</a>
                                </td>
                                <td width="10%">
                                    <form action="{{ route('units.destroy', $unit->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
