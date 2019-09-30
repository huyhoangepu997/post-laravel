@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            @if(count($categories))
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <a href="" class="text-decoration-none text-dark">{{ $category -> name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
