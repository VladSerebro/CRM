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
                        <table class="table">
                            <thead class = "thread-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Master</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div style="display: none">{{$i = 1}}</div>
                                @foreach ($projects as $project)
                                    <tr
                                        @switch($project->status->id)
                                            @case(1) class="table-primary" @break
                                            @case(2) class="table-warning" @break
                                            @case(3) class="table-danger" @break
                                            @case(4) class="table-success" @break
                                            @endswitch
                                    >
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><b><a href="{{ route('view_project', ['id' => $project->id]) }}">{{ $project->title }}</a></b></td>
                                        <td>{{ $project->master->name }}</td>
                                        <td>{{ $project->status->name }}</td>
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