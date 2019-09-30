@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Create Categories</div>
        <div class="card-body">
            @if($errors -> any())
                @foreach($errors -> all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
