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





/*Route::get('/', function(){

    return redirect()->route('all_tasks');
});*/

Route::get('/', 'ProjectController@index')
    ->middleWare('auth')
    ->name('all_projects');

Auth::routes();



Route::group(['prefix' => 'task'],
    function ()
    {
        Route::get('/all', 'TaskController@index')
            ->middleWare('auth')
            ->name('all_tasks');
    }
);
