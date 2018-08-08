<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\Comment as Comment;


class CommentController extends Controller
{
    public function delete($id)
    {
        $comment = Comment::find($id);

        Comment::destroy($id);

        return redirect()->route('view_task', ['id' => $comment->task->id]);

    }

    public function edit(Request $request, $id)
    {
        $edit_comment = Comment::find($id);
        $task = Task::with('master', 'performer', 'status', 'comments')->find($edit_comment->task->id);

        if($request->isMethod('post'))
        {
            $edit_comment->text = $request->input('text');

            $edit_comment->save();

            return redirect()->route('view_task',[
                'id' => $task->id,
                'request' => $request
            ]);
        }


        return view('tasks.edit_comment', [
            'task' => $task,
            'edit_comment' => $edit_comment,
            'request' => $request
        ]);
    }
}
