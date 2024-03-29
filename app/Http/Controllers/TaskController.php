<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tasks = Task::all();
        $task = Task::find(1)->id;


        //$task = tasks::find(all);
        //$tasks = auth($task)->user(id);

        return view('tasks.index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
        /*
        The create() function makes use of the view() method to return the create.
        blade.php template which needs to be present in the resources/views folder.
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
//validate GET requests
          'name'=>'required',
        ]);

        $tasks = new Task([
        'name'=> $request-> get('name'),
        'completed'=> $request-> get('completed'),
        'user_id' => auth()->id(),
        //ask about getting timestamps

       //This is based on requesting the field and getting the field
        // Once that is done user saves their new task entry and the whole thing is added to the database
        ]);
        $tasks-> save();
        return redirect('/tasks')->with('Succes!', 'Task Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $tasks = Task::find($id);
        return view('tasks.edit', compact('tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $task = Task::find($id);
        $task->name =  $request->get('name');
        $task->completed = $request->get('completed');
        $task->save();

        return redirect('/tasks')->with('success', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $tasks = Task::find($id);
        $tasks->delete();

        return redirect('/tasks')->with('success', 'Task deleted!');
    }
}
