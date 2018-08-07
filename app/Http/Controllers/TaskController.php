<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\User as User;
use App\Status as Status;
use App\Project as Project;
use App\Comment as Comment;

class TaskController extends Controller
{
    public function my_index(Request $request)
    {
        $my_id = $request->user()->id;
        $tasks = Task::where(['performer_id' => $my_id])
            ->with('master', 'performer', 'status')
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function view(Request $request, $id)
    {
        $task = Task::with('master', 'performer', 'status', 'comments')->find($id);

        return view('tasks.view', [
            'task' => $task,
            'request' => $request
        ]);
    }

    public function delete($id)
    {
        $task = Task::with('project')->find($id);
        $project_id = $task->project->id;

        Task::destroy($id);
        return redirect()->route('view_project', ['id' => $project_id]);
    }

    public function create(Request $request, $project_id)
    {
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'performer' => 'required|string|max:255',
                'status' => 'required|numeric'
            ]);

            Task::create([
                'title'         => $request->input('title'),
                'description'   => $request->input('description'),
                'performer_id'  => $request->input('performer'),
                'status_id'     => $request->input('status'),
                'master_id'     => $request->user()->id,
                'project_id'    => $project_id
            ]);

            return redirect()->route('view_project', ['id' => $project_id]);

        }

        $users = User::all();
        $statuses = Status::all();
        $project = Project::find($project_id);

        return view('tasks.create',[
            'users'     => $users,
            'statuses'  => $statuses,
            'project'   => $project
        ]);
    }

    public function edit(Request $request, $id)
    {
        $task = Task::find($id);

        if($request->isMethod('post'))
        {
            // if user can modify tasks
            if($request->user()->id === $task->master->id)
            {
                $this->validate($request, [
                    'title' => 'required|string|max:255',
                    'description' => 'required|string|max:255',
                    'performer' => 'required|string|max:255',
                    'status' => 'required|numeric'
                ]);

                $task->title = $request->input('title');
                $task->description = $request->input('description');
                $task->performer_id = $request->input('performer');
                $task->status_id = $request->input('status');

                $task->save();
            }

            if($request->input('comment') != "")
            {
                Comment::create([
                    'task_id' => $task->id,
                    'text' => $request->input('comment'),
                    'author_id' => $request->user()->id
                ]);
            }


            return redirect()->route('view_task',[
                'id' => $task->id,
                'request' => $request
            ]);
        }

        //$task = Task::find($id);
        $users = User::all();
        $statuses = Status::all();
        $project = Project::find($task->project_id);

        return view('tasks.edit',[
            'task' => $task,
            'users' => $users,
            'statuses' => $statuses,
            'project' => $project,
            'request' => $request
        ]);
    }
}
