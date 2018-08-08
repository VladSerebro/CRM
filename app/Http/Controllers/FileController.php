<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\File as File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request, $task_id)
    {
        $task = Task::find($task_id);

        if($request->isMethod('post')) {
            if($request->user()->id === $task->master->id) {

                $this->validate($request,[
                    'userfile' => 'required'
                ]);

                $file = $request->file('userfile');
                $contents = file_get_contents($file->getRealPath());
                $fileName = time() . $task->id . '_' . $file->getClientOriginalName();

                Storage::disk('public')->put($fileName, $contents);

                File::create([
                    'path' => $fileName,
                    'task_id' => $task->id
                ]);





                var_dump(asset('Storage/public/' . $fileName));
                echo "<a href = " . Storage::url($fileName) . ">gmak</href>";
                exit;









            }
        }

        return view('files.upload',[
            'task' => $task
        ]);
    }
}
