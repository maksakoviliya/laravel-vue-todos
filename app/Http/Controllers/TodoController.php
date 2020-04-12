<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTodos = Todo::where('user_id', auth()->user()->id)->get();

        $doneTodos = $allTodos->where('done', 1);
        $todos = $allTodos->where('done', 0);

        return response()->json(compact('todos', 'doneTodos'));
    }

    
    public function done(Request $request)
    {
        
        $todo = Todo::findOrFail($request->id);
        if ($todo->user_id == auth()->user()->id) {
            $todo->update(['done' => 1]);
        } else {
            return response()->json(['error' => 'Error']);
        }

        $allTodos = Todo::where('user_id', auth()->user()->id)->get();

        $doneTodos = $allTodos->where('done', 1);
        $todos = $allTodos->where('done', 0);

        return response()->json(compact('todos', 'doneTodos'));
    }

    public function cancel(Request $request)
    {
        
        $todo = Todo::findOrFail($request->id);
        if ($todo->user_id == auth()->user()->id) {
            $todo->update(['done' => 0]);
        } else {
            return response()->json(['error' => 'Error']);
        }

        $allTodos = Todo::where('user_id', auth()->user()->id)->get();

        $doneTodos = $allTodos->where('done', 1);
        $todos = $allTodos->where('done', 0);

        return response()->json(compact('todos', 'doneTodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = Todo::create([
            'body'    => $request->body,
            'user_id' => auth()->user()->id,
            'done'    => false
        ]);

        return response()->json(compact('todo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $todo = Todo::findOrFail($request->id);
        if ($todo->user_id == auth()->user()->id) {
            $todo->delete();
        } else {
            return response()->json(['error' => 403], 403);
        }

        $allTodos = Todo::where('user_id', auth()->user()->id)->get();

        $doneTodos = $allTodos->where('done', 1);
        $todos = $allTodos->where('done', 0);

        return response()->json(compact('todos', 'doneTodos'));
    }
}
