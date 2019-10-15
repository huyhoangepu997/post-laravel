@extends('layouts.unit')
@section('content')

    <div class="card card-default">
        <div class="card-header">
            Edit
        </div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ route('units.update', $unit->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $unit->name }}">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        @foreach($unitsType as $unitType)
                            <option value="{{ $unitType->id }}" @if($unitType->id == $unit->type) selected @endif>{{ $unitType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="symbol">Symbol</label>
                    <input type="text" id="symbol" name="symbol" class="form-control" value="{{ $unit->symbol }}">
                </div>
                <div class="form-group">
                    <label for="default">Default</label>
                    <select name="default" id="default" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
