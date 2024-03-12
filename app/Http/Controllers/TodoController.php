<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Events\TodoEvent;

class TodoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ])->validate();

        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Todo created successfully', 'todo' => $todo], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::findOrFail($id);
        return response()->json(['todo' => $todo], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        throw new \Exception('Method not implemented');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->all());
        return response()->json(['message' => 'Todo updated successfully', 'todo' => $todo], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::destroy($id);
        return response()->json(['message' => 'Todo deleted successfully'], 200);
    }

    public function toggleIsCompleted(int $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update(['completed' => !$todo->completed]);
        event(new TodoEvent($todo));
        return response()->json(['message' => 'Todo updated successfully', 'todo' => $todo], 200);
    }
}
