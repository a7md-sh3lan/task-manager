<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = auth()->user()->tasks;
        return view('tasks.index',  ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
        ]);
    
    
        $items = Task::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => fake()->sentence(15, true),
        ]);
    
    
        return back()->with('success','Task created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $this->validate($request,[
            'title' => 'required',
        ]);

        if($task->user_id == auth()->user()->id) {
            $task->update([
                'title' => $request->title,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        if($task->user_id == auth()->user()->id) {
            $task->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully..'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully..'
        ]);
    }

    /**
     * Toggle the Task if Completed or Not.
     */
    public function toggle(Request $request)
    {
        //
        $this->validate($request,[
            'task_id' => 'required',
        ]);

        $task = Task::find($request->task_id);

        if($task->user_id == auth()->user()->id) {
            $task->update(['completed' => !$task->completed]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully..'
        ]);
    }
}
