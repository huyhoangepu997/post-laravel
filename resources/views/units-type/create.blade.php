@extends('layouts.unit')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($unitType) ? 'Edit Unit Type' : 'Create Unit Type' }}
        </div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
{{--            {{ dd($unitType) }}--}}

            <form action="{{ isset($unitType) ? route('units-type.update', $unitType->id) : route('units-type.store') }}" method="post">
                @csrf
                @if(isset($unitType))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($unitType) ? $unitType->name : '' }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($unitType) ? 'Edit' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
