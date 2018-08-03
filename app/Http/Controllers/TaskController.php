<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\User as User;
use App\Status as Status;
use App\Project as Project;

class TaskController extends Controller
{
    public function view(Request $request, $id)
    {

        $task = Task::with('master', 'performer', 'status')->find($id);

        return view('tasks.view', [
            'task' => $task
        ]);
    }

    public function delete($id)
    {
        $task = Task::with('project')->find($id);
        $project_id = $task->project->id;

        Task::destroy($id);
        return redirect()->route('view_project', ['id' => $project_id]);
    }


}
