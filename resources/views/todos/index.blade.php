@extends('layouts.app')

@section('styles')
<style>
    #outer
    {
        width:auto;
        text-align: center;
    }
    .inner
    {
        display: inline-block;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if(Session::has('alert-success'))
                        <div class="alert alert-success" role="alert">
                           {{Session::get('alert-success')}}
                        </div>
                    @endif

                    @if(Session::has('alert-info'))
                        <div class="alert alert-info" role="alert">
                           {{Session::get('alert-info')}}
                        </div>
                    @endif


                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                           {{Session::get('error')}}
                        </div>
                    @endif

                    <a class="btn btn-sm btn-info" href="{{url('todos/create')}}">Create Todo</a>

                    @if(count($todos) > 0)
                        <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Completed</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($todos as $todo)
                                    <tr>
                                        <td>{{$todo->title}}</td>
                                        <td>{{$todo->description}}</td>
                                        <td>
                                            @if($todo->is_completed == 1)
                                                <a href="" class="btn btn-sm btn-success">completed</a>
                                            @else
                                                <a href="" class="btn btn-sm btn-danger">in completed</a>
                                            @endif
                                        </td>

                                        <td id="outer">
                                            <a href="{{route('todos.show', $todo->id)}}" class="inner btn btn-sm btn-success">View</a>
                                            <a href="{{route('todos.edit', $todo->id)}}" class="inner btn btn-sm btn-info">Edit</a>

                                            <form action="{{route('todos.destroy', $todo->id)}}" method="post" class="inner">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-sm btn-danger" 
                                                value="Delete" onclick="return confirm('delete this title?');">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4>No todos are created yet</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
