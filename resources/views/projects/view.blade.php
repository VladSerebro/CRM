@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    {{--Project information--}}
                    <div class="alert alert-dark" role="alert">
                        <b>{{$project->title}}</b>
                    </div>

                    <div class="panel-body">
                        <p>{{$project->description}}</p>

                        <table class="table">
                            <tbody>
                                <tr
                                        @switch($project->status->id)
                                        @case(1) class="text-primary" @break
                                        @case(2) class="text-warning" @break
                                        @case(3) class="text-danger" @break
                                        @case(4) class="text-success" @break
                                        @endswitch
                                >
                                    <td><b>Status</b></td>
                                    <td>{{ $project->status->name }}</td>
                                </tr>
                                <tr class = "table-light">
                                    <td><b>Master</b></td>
                                    <td>{{$project->master->name}}</td>
                                </tr>
                                <tr class = "table-light">
                                    <td><b>Updated at</b></td>
                                    <td>{{$project->updated_at}}</td>
                                </tr>
                                <tr class = "table-light">
                                    <td><b>Created at</b></td>
                                    <td>{{$project->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>

                        @if($request->user()->id === $project->master->id)
                            <div class="row">
                                <form class="col-sm-2" action="{{ route('delete_project', ['id' => $project->id]) }}" method="post">
                                    {!! method_field('delete') !!}
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-danger">
                                        Delete project
                                    </button>
                                </form>
                                <div class="col-sm-6">
                                    <a class="btn btn-primary" href = "{{ route('new_task', ['project_id' => $project->id])}}">
                                        Add task
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                        {{--Tasks--}}
                    <div class="pt-5">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Performer</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->tasks as $task)
                                <tr>
                                    <td scope="col">{{ $task->title }}</td>
                                    <td scope="col">{{ $task->performer->name }}</td>
                                    <td scope="col">{{ $task->status->name }}</td>
                                    <td scope="col"><a href="{{ route('view_task', [
                                        'project_id' => $project->id,
                                        'task_id' => $task->id,
                                    ]) }}">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection