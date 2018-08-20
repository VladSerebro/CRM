@extends('layouts/app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    {{--Tasks--}}
                    <div class="pt-5">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Master</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td scope="col">{{ $task->title }}</td>
                                    <td scope="col">{{ $task->project->master->name }}</td>
                                    <td scope="col">{{ $task->status->name }}</td>
                                    <td scope="col"><a href="{{ route('view_task', ['project_id' => $task->project_id , 'task_id' => $task->id]) }}">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>




















                    {{--  <div>

                          {{ $task->performer->name }} --> {{ $task->title }}


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
                          @endif

                      </div>--}}



                </div>
            </div>
        </div>
    </div>

@endsection