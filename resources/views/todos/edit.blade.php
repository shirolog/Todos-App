@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todos App</div>

                <div class="card-body">
                        <h4>Edit Form</h4>
                        <form action="{{route('todos.update', $todo->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                value="{{$todo->title}}">
                            </div>

                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="desc" rows="5" 
                                cols="5">{{$todo->description}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="is_completed" class="form-control" id="status">
                                    <option value=""  disabled selected>
                                        Select Option
                                    </option>
                                    <option value="1">Completed</option>
                                    <option value="0">In Completed</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
