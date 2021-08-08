<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderBy('id', 'desc')->get();
        return view('welcome', ['tasks' => $tasks]);
    }

    public function save() {
        $task = new Task();

        $task->task = request('task');
        $task->is_done = 0;

        $task->save();

        return redirect('/');
    }

    public function editname($id) {
        $originaltask = Task::findOrFail($id);

        $is_editing = $originaltask->is_editing;

        $id = $originaltask->id;
        $is_done = $originaltask->is_done;

        if ($is_editing)
            $name = request('new_task');
        else {
            $name = $originaltask->task;
        }

        $is_editing = !$is_editing;

        $newtask=array('id'=>$id,'task'=>$name, 'is_done'=>$is_done, 'is_editing'=>$is_editing);
        Task::whereId($id)->update($newtask);

        return redirect('/');
    }

    public function delete($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/');
    }

    public function changestatus($id) {
        $originaltask = Task::findOrFail($id);

        $id = $originaltask->id;
        $name = $originaltask->task;
        $is_done = !$originaltask->is_done;
        $is_editing = $originaltask->is_editing;

        $newtask=array('id'=>$id,'task'=>$name, 'is_done'=>$is_done, 'is_editing'=>$is_editing);
        
        Task::whereId($id)->update($newtask);

        return redirect('/');
    }
}

