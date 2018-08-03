@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p><b>{{$project->title}}</b></p>
                    </div>

                    <div class="panel-body">
                        <p>{{$project->description}}</p>
                        <p><b>Status:</b> {{$project->status->name}}</p>
                        <p><b>Author:</b> {{$project->master->name}}</p>

                        <p><b>Updated at:</b> {{$project->updated_at}}</p>
                        <p><b>Created at:</b> {{$project->created_at}}</p>

                        @if($request->user()->id === $project->master->id)
                            <form action="{{ route('delete_project', ['id' => $project->id]) }}" method="post">
                                {!! method_field('delete') !!}
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-danger">
                                    Delete project
                                </button>
                            </form>
                        @endif
                    </div>



                    @foreach($project->tasks as $task)
                        <div>

                            {{ $task->master->name }} -->
                            {{ $task->title }}

                            <a class="btn btn-primary" href = "{{ route('view_task', ['id' => $task->id]) }}">
                                 View
                            </a>
                            @if($request->user()->id === $project->master->id)
                                <form action="{{ route('delete_task', ['id' => $task->id]) }}" method="post">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>








                            {{--    <a class="btn btn-danger" href = "{{ route('delete_task', [
                                'id' => $task->id,
                                'project_id' => $project->id
                                ]) }}">
                                    Delete
                                </a>--}}
                            @endif



                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

@endsection