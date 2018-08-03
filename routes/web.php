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

        Route::get('/view/{id}', 'ProojectController@view')
            ->middleWare('auth')
            ->name('view_project');
    }
);






Route::group(['prefix' => 'task'],
    function ()
    {
        Route::get('/all', 'TaskController@index')
            ->middleWare('auth')
            ->name('all_tasks');
    }
);
