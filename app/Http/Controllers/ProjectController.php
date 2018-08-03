<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project as Project;
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

    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'status' => 'required|numeric'
            ]);

            Project::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status_id' => $request->input('status'),
                'master_id' => $request->user()->id
            ]);

            return redirect()->route('all_projects');
        }

        $users = User::all();
        $statuses = Status::all();

        return view('projects.create', [
            'users' => $users,
            'statuses' => $statuses
            ]);
    }
}
