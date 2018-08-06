@extends('layouts.app')

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

                        @if($request->user()->id === $task->master->id)
                            <div class="row">
                                <form action="{{ route('delete_task', ['id' => $task->id]) }}" method="post" class="col-sm-2">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                                <div class="col-sm-5">
                                    <a class="btn btn-primary" href = "{{ route('edit_task', ['id' => $task->id]) }}">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection