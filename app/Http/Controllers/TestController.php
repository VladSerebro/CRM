<?php
namespace App\Http\Controllers;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller {
    public function index()
    {
        //var_dump($request);
        //var_dump($request->ajax());
        //echo $request->ajax();


        if($_POST != null)
        {
            //echo 'this is post';
            //var_dump($_POST['text']);

            return response(var_dump($_POST['text']));
        }

        /*if($request->isMethod('post'))
        {
            echo 'this is post';
            var_dump($_POST);
            exit;
        }*/

        return view('new');

    }
}