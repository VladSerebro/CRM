<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment as Comment;

class CommentController extends Controller
{
    public function delete($id)
    {
        $comment = Comment::find($id);

        Comment::destroy($id);

        return redirect()->route('view_task', ['id' => $comment->task->id]);

    }
}
