<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\File as File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request, $project_id, $task_id)
    {
        if($request->isMethod('post'))
        {
            $task = Task::find($task_id);
            if($request->user()->id === $task->master->id)
            {
                $this->validate($request,[
                    'userfile' => 'required'
                ]);

                $file = $request->file('userfile');
                $contents = file_get_contents($file->getRealPath());
                $fileName = time() . $task->id . '_' . $file->getClientOriginalName();

                Storage::disk('public')->put($fileName, $contents);

                File::create([
                    'path' => $fileName,
                    'task_id' => $task->id,
                    'description' => $file->getClientOriginalName()
                ]);

                return redirect()->route('view_task', ['project_id' => $project_id, 'task_id' => $task_id]);
            }
        }

        return view('files.upload',[
            'project_id'    => $project_id,
            'task_id'       => $task_id,
        ]);
    }

    public function delete($project_id, $task_id, $file_id)
    {
/*        $file = File::find($id);
        $task = Task::find($file->task_id);*/

        File::destroy($file_id);

        return redirect()->route('view_task', ['project_id' => $project_id, 'task_id' => $task_id]);
    }
}
