@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <form method="post" action="{{ route('upload_file', ['task_id' => $task->id]) }}" enctype="multipart/form-data" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input class="input-group-text" type="file" name="userfile">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Загрузить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
