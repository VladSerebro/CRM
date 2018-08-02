@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        Projects
                        <a href="{{ route('new_project') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i>New
                        </a>
                    </div>
                    <div class="media-body">
                        <table class="table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Master</th>
                                <th>Status</th>
                            </tr>
                            <div style="display: none">{{$i = 1}}</div>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="{{--{{ route('view_task', ['id' => $task->id]) }}--}}">{{ $project->title }}</a></td>
                                    <td>{{ $project->master->name }}</td>
                                    <td>{{ $project->status->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection