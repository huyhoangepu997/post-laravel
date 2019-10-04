@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body">
            @if($errors -> any())
                @foreach($errors -> all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ isset($category) ? route('categories.update', $category -> id) : route('categories.store') }}" method="post">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category -> name : '' }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($category) ? 'Edit Category' : 'Add Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
