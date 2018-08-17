<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', function(){
    return redirect()->route('all_projects');
});

Auth::routes();






/*======--------------------------------------------------------======*/

Route::get('test', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');
});

/*======--------------------------------------------------------======*/







Route::group(['prefix' => 'project'],
    function ()
    {
        Route::get('/all', 'ProjectController@index')
            ->middleWare('auth')
            ->name('all_projects');

        Route::get('/my_projects', 'ProjectController@my_index')
            ->middleWare('auth')
            ->name('my_projects');

        Route::match(['get', 'post'], '/new', 'ProjectController@create')
            ->middleWare('auth')
            ->name('new_project');

        Route::delete('delete/{id}', 'ProjectController@delete')
            ->middleWare('auth')
            ->name('delete_project');

        Route::get('/view/{id}', 'ProjectController@view')
            ->middleWare('auth')
            ->name('view_project');


        /*======= Tasks ========*/
        Route::group(['prefix' => '{project_id}/task'],
            function ()
            {
                Route::get('/view/{id}', 'TaskController@view')
                    ->middleWare('auth')
                    ->name('view_task');

                Route::match(['get', 'post'], '/new', 'TaskController@create')
                    ->middleWare('auth')
                    ->name('new_task');

                Route::delete('delete/{id}', 'TaskController@delete')
                    ->middleWare('auth')
                    ->name('delete_task');

                Route::match(['get', 'post'], '/edit/{id}', 'TaskController@edit')
                    ->middleWare('auth')
                    ->name('edit_task');


                /*======= Comments ========*/
                Route::group(['prefix' => '{task_id}/comment'],
                    function ()
                    {
                        Route::get('/delete/{id}', 'CommentController@delete')
                            ->middleWare('auth')
                            ->name('delete_comment');

                        Route::match(['get', 'post'], '/edit/{id}', 'CommentController@edit')
                            ->middleWare('auth')
                            ->name('edit_comment');
                    }
                );


                /*======= Files ========*/
                Route::group(['prefix' => '{task_id}/file'],
                    function ()
                    {
                        Route::match(['get', 'post'], '/upload', 'FileController@upload')
                            ->middleWare('auth')
                            ->name('upload_file');

                        Route::get('/delete/{id}', 'FileController@delete')
                            ->middleWare('auth')
                            ->name('delete_file');
                    }
                );
            }
        );
    }
);



Route::group(['prefix' => 'task'],
    function ()
    {
        Route::get('/my_tasks', 'TaskController@my_index')
            ->middleWare('auth')
            ->name('my_tasks');

        /*Route::get('/view/{id}', 'TaskController@view')
            ->middleWare('auth')
            ->name('view_task');*/

        /*Route::delete('delete/{id}', 'TaskController@delete')
            ->middleWare('auth')
            ->name('delete_task');*/

        /*Route::match(['get', 'post'], '/new/{project_id}', 'TaskController@create')
            ->middleWare('auth')
            ->name('new_task');*/

        /*Route::match(['get', 'post'], '/edit/{id}', 'TaskController@edit')
            ->middleWare('auth')
            ->name('edit_task');*/
    }
);

Route::group(['prefix' => 'comment'],
    function ()
    {
        /*Route::get('/delete/{id}', 'CommentController@delete')
            ->middleWare('auth')
            ->name('comment_delete');*/

        /*Route::match(['get', 'post'], '/edit/{id}', 'CommentController@edit')
            ->middleWare('auth')
            ->name('edit_comment');*/
    }
);

Route::group(['prefix' => 'file'],
    function ()
    {
        /*Route::match(['get', 'post'], '/upload_to_task/{task_id}', 'FileController@upload')
            ->middleWare('auth')
            ->name('upload_file');*/

        /*Route::get('/delete/{id}', 'FileController@delete')
            ->middleWare('auth')
            ->name('delete_file');*/
    }
);

