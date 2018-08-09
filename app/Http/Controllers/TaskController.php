<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as Storage;

use App\Task as Task;
use App\User as User;
use App\Status as Status;
use App\Project as Project;
use App\Comment as Comment;
use App\File as File;

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

    public function view(Request $request, $project_id, $task_id)
    {
        $task = Task::with('master', 'performer', 'status', 'comments')->find($task_id);
        $files = File::where(['task_id' => $task_id])->get();

        return view('tasks.view', [
            'project_id' => $project_id,
            'task' => $task,
            'files' => $files,
            'request' => $request
        ]);
    }

    public function delete($project_id, $task_id)
    {
        Task::destroy($task_id);
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

    public function edit(Request $request, $project_id, $task_id)
    {
        $task = Task::find($task_id);

        if($request->isMethod('post'))
        {
            // Can user modify tasks?
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
                'project_id' => $project_id,
                'task_id' => $task->id,
                'request' => $request
            ]);
        }

        $users = User::all();
        $statuses = Status::all();

        return view('tasks.edit',[
            'task' => $task,
            'users' => $users,
            'statuses' => $statuses,
            'project_id' => $project_id,
            'request' => $request
        ]);
    }

}
