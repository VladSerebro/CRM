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
                    <div class="panel-body">
                        <p>{{$task->description}}</p>
                        <p><b>Status:</b> {{ $task->status->name }}</p>
                        <p><b>Master:</b> {{ $task->master->name }}</p>
                        <p><b>Performer:</b> {{ $task->performer->name }}</p>

                        <p><b>Updated at:</b> {{$task->updated_at}}</p>
                        <p><b>Created at:</b> {{$task->created_at}}</p>

                        @if($request->user()->id === $task->master->id  || $request->user()->id === $task->performer->id)

                            <div class="row">
                                @if($request->user()->id === $task->master->id)
                                <form action="{{ route('delete_task', ['id' => $task->id]) }}" method="post" class="col-sm-2">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                                @endif
                                <div class="col-sm-5">
                                    <a class="btn btn-primary" href = "{{ route('edit_task', ['id' => $task->id]) }}">
                                        Edit
                                    </a>
                                </div>
                            </div>

                            <div class="alert alert-primary mt-5" role="alert">
                                Comments
                            </div>
                            <table class="table">
                                <tbody>
                                @foreach($task->comments as $comment)
                                    <tr>
                                        <td>{{ $comment->created_at }}</td>
                                        <th>{{ $comment->author->name }}</th>
                                        <td>{{ $comment->text }}</td>
                                        <td>
                                            @if($request->user()->id === $comment->author->id)
                                            <form action="{{ route('comment_delete', ['id' => $comment->id]) }}" method="get" class="col-sm-2">
                                                {{--{!! method_field('delete') !!}--}}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
















                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection