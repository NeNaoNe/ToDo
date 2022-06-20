<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $all_tasks = $this->todo->latest()->get();
        //SELECT * FROM todos ORDER BY created _at DESC
        return view ('todo.index')->with('all_tasks', $all_tasks);
    }

    public function store(Request $request)
    {
        // $request - holds all the data from the form
        $request->validate([
            'task' => 'required|min:1|max:50'
        ]);

        $this->todo->task = $request->task;
        // $this->todo->task = "Water the plants";
        $this->todo->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $task = $this->todo->findOrFail($id);
        //SELECT * FROM todos WHERE id = $id;

        return view ('todo.edit')->with('task', $task);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'required|min:1|max:50'
        ]);

        $task       = $this->todo->findOrFail($id);
        $task->task = $request->task;
        // $task 3 ->task colum = "Pay internet bill"
        // $task->task       - from the database
        // $request->task    - from the form
        $task->save();

        return redirect()->route('index');
    }

    public function destroy($id)
    {
        $this->todo->destroy($id);
        // DELETE FROM todos WHERE id = $id;
        return redirect()->back();
    }
}
