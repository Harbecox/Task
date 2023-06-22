<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tasks'] = Task::query()->orderByDesc("created_at")->paginate(5);
        return view("task.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['action'] = route("tasks.store");
        $data['method'] = "post";
        $data['users'] = User::query()->where("role","user")->whereNot("id",Auth::user()->id)->get();
        return view("task.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        Auth::user()->tasks()->create($request->validated());
        return response()->redirectToRoute("tasks.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $data['users'] = User::query()->where("role","user")->whereNot("id",Auth::user()->id)->get();
        $data['action'] = route("tasks.update",$task);
        $data['method'] = "put";
        $data['task'] = $task;
        return view("task.create",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());
        return response()->redirectToRoute("tasks.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}
