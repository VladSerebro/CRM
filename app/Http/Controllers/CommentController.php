<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\Comment as Comment;
use App\File as File;


class CommentController extends Controller
{
    public function delete($project_id, $task_id, $comment_id)
    {
        Comment::destroy($comment_id);
        return redirect()->route('view_task', ['project_id' => $project_id, 'task_id' => $task_id]);

    }

    /*public function edit(Request $request, $project_id, $task_id, $comment_id)
    {
        $task = Task::with('master', 'performer', 'status', 'comments')->find($task_id);
        $files = File::where(['task_id' => $task_id])->get();
        $edit_comment = Comment::find($comment_id);



        if($request->isMethod('post'))
        {
            $edit_comment->text = $request->input('text');

            $edit_comment->save();

            return redirect()->route('view_task',[
                'project_id' => $project_id,
                'task_id' => $task_id,
            ]);
        }

        return view('tasks.edit_comment', [
            'project_id' => $project_id,
            'task' => $task,
            'files' => $files,
            'request' => $request,

            'edit_comment' => $edit_comment

        ]);
    }*/

    public function edit(Request $request, $project_id = null, $task_id = null, $comment_id = null)
    {
        if($_POST != null)
        {
            $comment = Comment::find($comment_id);

            $comment->text = $_POST['textVal'];

            $comment->save();

            //return response($comment->text);
        }
    }
}
