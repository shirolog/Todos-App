<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {
        $todo = new Todo;

        $todo-> title = $request->input('title');
        $todo-> description = $request->input('description');
        $todo-> is_completed = $request->input('is_completed');
        $todo->save();

        session()->flash('alert-success', 'Todo Created Successfully!');

        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {   
        $todos = Todo::all();

        if(!$todo){
            session()->flash('error', 'Unable to locate the Todo!');
            return redirect()->route('todos.index');
        }

        return view('todos.show', compact('todo', 'todos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {   
        if(!$todo){
            session()->flash('error', 'Unable to locate the Todo!');
            return redirect()->route('todos.index');
        }
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequest $request, Todo $todo)
    {   

        if(!$todo){
            session()->flash('error', 'Unable to locate the Todo!');
            return redirect()->route('todos.index');
        }

        
        $todo-> title = $request->input('title');
        $todo-> description = $request->input('description');
        $todo-> is_completed = $request->input('is_completed');
        $todo->save();
        session()->flash('alert-info', 'Todo Updated Successfully!');
        return redirect()->route('todos.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        
        if(!$todo){
            session()->flash('error', 'Unable to locate the Todo!');
            return redirect()->route('todos.index')
            ->withErrors([
                'error' => 'Unable to locate the Todo'
            ]);
        }

        session()->flash('alert-success', 'Todo Deleted Successfully!');

        return redirect()->route('todos.index');
    }
}
