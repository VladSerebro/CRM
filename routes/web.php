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





Route::group(['prefix' => 'project'],
    function ()
    {
        Route::get('/all', 'ProjectController@index')
            ->middleWare('auth')
            ->name('all_projects');

        Route::match(['get', 'post'], '/new', 'ProjectController@create')
            ->middleWare('auth')
            ->name('new_project');

        Route::get('/view/{id}', 'ProjectController@view')
            ->middleWare('auth')
            ->name('view_project');

        Route::delete('delete/{id}', 'ProjectController@delete')
            ->middleWare('auth')
            ->name('delete_project');
    }
);



Route::group(['prefix' => 'task'],
    function ()
    {
        Route::get('/view/{id}', 'TaskController@view')
            ->middleWare('auth')
            ->name('view_task');

        Route::delete('delete/{id}', 'TaskController@delete')
            ->middleWare('auth')
            ->name('delete_task');

        Route::match(['get', 'post'], '/new/{project_id}', 'TaskController@create')
            ->middleWare('auth')
            ->name('new_task');

        Route::match(['get', 'post'], '/edit/{id}', 'TaskController@edit')
            ->middleWare('auth')
            ->name('edit_task');
    }
);
