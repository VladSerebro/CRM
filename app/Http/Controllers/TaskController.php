<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\User as User;
use App\Status as Status;
use App\Project as Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Project::with('master', 'status', 'tasks')->get();

        return view('tasks.index',[
            'tasks' => $tasks
        ]);
    }


}
