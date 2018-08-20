<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task as Task;
use App\File as File;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Drive;
use Mockery\Exception;
use Google_Service_Drive_DriveFile;
use Google_DriveFile;

//require '/vendor/autoload.php';

class FileController extends Controller
{
    private function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setScopes(Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setAuthConfig(ROOT . '/credentials.json');
        $client->setAccessType('offline');

        // Load previously authorized credentials from a file.
        $credentialsPath = ROOT . '/token.json';
        if (file_exists($credentialsPath)) {
            $accessToken = json_decode(file_get_contents($credentialsPath), true);
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }

            // Store the credentials to disk.
            if (!file_exists(dirname($credentialsPath))) {
                mkdir(dirname($credentialsPath), 0700, true);
            }
            file_put_contents($credentialsPath, json_encode($accessToken));
            printf("Credentials saved to %s\n", $credentialsPath);
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired())
        {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }

        var_dump($client); exit;

        return $client;
    }

    public function upload(Request $request, $project_id = null, $task_id = null)
    {
/*        if($request->isMethod('post'))
        {
            $task = Task::find($task_id);
            if($request->user()->id === $task->master->id)
            {
                /*$this->validate($request, [
                    'userfile' => 'requred'
                ]);


                $client = $this->getClient();
                $service = new Google_Service_Drive($client);


                $file = $request->file('userfile');
                $contents = file_get_contents($file->getRealPath());
                $fileName = time() . $task->id . '_' . $file->getClientOriginalName();





                //Insert a file
                $file = new Google_Service_Drive_DriveFile();
                $file->setName(uniqid().'.jpg');
                $file->setDescription('A test document');
                $file->setMimeType('image/jpeg');

                $data = $contents;

                $createdFile = $service->files->create($file, array(
                    'data' => $data,
                    'mimeType' => 'image/jpeg',
                    'uploadType' => 'multipart'
                ));


            }
        }*/

        if($request->isMethod('post'))
        {
            if($_POST != null)
            {
                $name = $_POST['fileName'];
                $contents = $_POST['contents'];

                Storage::disk('public')->put($name, $contents);


                File::create([
                    'path' => $name,
                    'task_id' => $task_id,
                    'description' => $name
                ]);

                return response('File downloaded');
            }
        }






        /*OLD CODE (without js)
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
        ]);*/
    }

    public function delete($project_id, $task_id, $file_id)
    {
        $file = File::find($file_id);
        $path = $file->path;

        /*Deleting file from the storage*/
        if(Storage::disk('public')->exists($path))
            Storage::disk('public')->delete($path);

        /*Deleting file from DB*/
        File::destroy($file_id);

        return redirect()->route('view_task', ['project_id' => $project_id, 'task_id' => $task_id]);
    }
}
