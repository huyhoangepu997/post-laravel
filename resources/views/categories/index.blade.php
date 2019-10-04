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
                            <button class="btn btn-danger btn-sm float-right ml-2" onclick="handleDelete({{ $category -> id }})">Delete</button>
                            <a href="{{ route('categories.edit', $category -> id) }}" class="btn btn-info btn-sm float-right">Edit</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="post" id="deleteCategoryForm">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center font-weight-bold">Are you sure you want to delete this category?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back!</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function handleDelete(id) {
            let form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id;
            console.log(form);
            $('#deleteModel').modal('show');
        }
    </script>
@endsection
