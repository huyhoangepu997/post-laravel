@extends('layouts.unit')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('units-conversion.create') }}" class="btn btn-success">Create Unit Conversion</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Units Conversion
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Unit Type</th>
                    <th>From Code</th>
                    <th>To Code</th>
                    <th>Value</th>
                    <th>Checksum</th>
                    <th>Action</th>
                    <th></th>
                </thead>
                <tbody>
                    @if(count($unitsConversion))
                        @foreach($unitsConversion as $unitConversion)
                            <tr>
                                <td>{{ $unitConversion->type_id }}</td>
                                <td>{{ $unitConversion->from_code }}</td>
                                <td>{{ $unitConversion->to_code }}</td>
                                <td>{{ $unitConversion->value }}</td>
                                <td>{{ $unitConversion->checksum }}</td>
                                <td width="10%">
                                    <a href="{{ route('units-conversion.edit', $unitConversion->id) }}" class="btn btn-info btn-sm">Edit</a>
                                </td>
                                <td width="10%">
                                    <form action="{{ route('units-conversion.destroy', $unitConversion->id) }}" method="post">
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
