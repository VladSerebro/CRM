@extends('layouts.app')

@section('navBarInsert')
    <li class="nav-item @if (Request::url() == route('my_projects')) active @endif ">
        <a class="nav-link" href="{{ route('view_project', ['id'=>$task->project->id]) }}">To: {{ $task->project->title }} <span class="sr-only">(current)</span></a>
    </li>
@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="alert alert-dark" role="alert">
                            <b>{{ $task->title }}</b>
                        </div>
                    </div>

                    <div>
                        <table>
                           <tbody>
                                <tr class="table-hover">
                                    <td><b>Description: </b></td>
                                    <td><i>{{ $task->description }}</i></td>
                                </tr>
                                <tr @switch($task->status->id)
                                        @case(1) class="text-primary" @break
                                        @case(2) class="text-warning" @break
                                        @case(3) class="text-danger" @break
                                        @case(4) class="text-success" @break
                                    @endswitch>
                                    <td><b>Status: </b></td>
                                    <td>{{ $task->status->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Master: </b></td>
                                    <td>{{ $task->master->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Performer: </b></td>
                                    <td>{{ $task->performer->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Updated at: </b></td>
                                    <td>{{ $task->updated_at }}</td>
                                </tr>
                                <tr>
                                    <td><b>Created at: </b></td>
                                    <td>{{ $task->created_at }}</td>
                                </tr>
                           </tbody>
                        </table>
                    </div>

                    @if($request->user()->id === $task->master->id)
                        <div class="row pt-3">
                            <form action="{{ route('delete_task', ['project_id' => $project_id , 'task_id' => $task->id]) }}" method="post" class="col-sm-1">
                                {!! method_field('delete') !!}
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                            <div class="col-sm-3">
                                <a class="btn btn-primary btn-sm" href = "{{ route('edit_task', ['project_id' => $project_id , 'task_id' => $task->id]) }}">
                                    Edit
                                </a>
                            </div>
                            <div>
                                <a class="btn btn-primary btn-sm" href = "{{ route('upload_file', ['project_id' => $project_id , 'task_id' => $task->id]) }}">
                                    Add file
                                </a>
                            </div>
                        </div>

                        @if($files != null)

                        <div class="alert alert-primary mt-5" role="alert">
                            Files
                        </div>

                        <table>
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        <a href="{{ Storage::url($file->path) }}" class="badge badge-info">{{ $file->description }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('delete_file', [
                                            'project_id' => $project_id,
                                            'task_id' => $task->id,
                                            'file_id' => $file->id
                                          ]) }}" class="btn btn-sm btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>
                                            Del
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        @endif {{-- @if($files != null) --}}
                    @endif {{-- @if($request->user()->id === $task->master->id) --}}

                    <div class="panel-body">
                        <div class="alert alert-primary mt-5" role="alert">
                            Comments
                        </div>
                        @section('comments')
                            <table class="table">
                                <tbody>
                                @foreach($task->comments as $comment)
                                    <tr>
                                        <td>{{ $comment->created_at }}</td>
                                        <th>{{ $comment->author->name }}</th>
                                        <td>
                                            <div id={{ 'comment_text' . $comment->id }}>
                                                {{ $comment->text }}
                                            </div>
                                            <textarea style="display: none" id={{ 'comment_editor' . $comment->id }} class="form-control"
                                                      name="text"
                                                      rows="3">
                                                {{ $comment->text }}
                                            </textarea>
                                        </td>
                                        <td>
                                            @if($request->user()->id === $comment->author->id)
                                                <div class="row">

                                                    <button class="btn-edit btn btn-primary btn-sm" id={{ 'btn_edit' . $comment->id }}>Edit</button>
                                                    <button class="btn-save btn btn-primary btn-sm" style="display: none" id={{ 'btn_save' . $comment->id }}>Save</button>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('.btn-edit').click(function(event){
                                                                event.preventDefault();

                                                                var str_id = event.target.id,
                                                                comment_id = str_id.replace('btn_edit', ""),

                                                                btnEdit = $(this),
                                                                btnSave = $('#btn_save' + comment_id),
                                                                commentObj = $('#comment_text' + comment_id),
                                                                editorObj = $('#comment_editor' + comment_id);

                                                                btnEdit.hide();
                                                                btnSave.show();
                                                                commentObj.hide();
                                                                editorObj.show();

                                                                editorObj.text(commentObj.text());
                                                            });


                                                            $('.btn-save').click(function(event){
                                                                event.preventDefault();

                                                                var str_id = event.target.id,
                                                                comment_id = str_id.replace('btn_save', ""),

                                                                btnSave = $(this),
                                                                btnEdit = $('#btn_edit' + comment_id),
                                                                commentObj = $('#comment_text' + comment_id),
                                                                editorObj = $('#comment_editor' + comment_id);

                                                                btnSave.hide();
                                                                btnEdit.show();
                                                                editorObj.hide();
                                                                commentObj.show();

                                                                var str = editorObj[0].value;

                                                                commentObj.text(str);

                                                                $.ajax({
                                                                    url: '/project/0/task/0/comment/edit/' + comment_id,
                                                                    method: 'POST',
                                                                    data: {
                                                                        _token: "{{ csrf_token() }}",
                                                                        textVal: str
                                                                    },
                                                                    success: function(data){
                                                                        //alert('saved successfully');
                                                                    }
                                                                });
                                                            });
                                                        });

                                                    </script>



                                                    <form action="{{ route('delete_comment', [
                                                        'project_id' => $project_id,
                                                        'task_id' => $task->id,
                                                        'comment_id' => $comment->id
                                                    ]) }}" method="get">
                                                        {{--{!! method_field('delete') !!}--}}
                                                        {!! csrf_field() !!}
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @show
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection