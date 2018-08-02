<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project as Project;
use App\Task as Task;
use App\User as User;
use App\Status as Status;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('master', 'status', 'tasks')->get();

        return view('projects.index',[
            'projects' => $projects
        ]);
    }
}
