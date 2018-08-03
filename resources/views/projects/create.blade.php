@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <label for="Input errors" class="col-sm-3 control-label">Error</label>
                            <!-- Список ошибок формы -->
                            <strong>ERROR!</strong>
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="panel-heading">Create</div>

                    <div class="panel-body">
                        <form action="{{route('new_project')}}" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="project-title" class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" id="project-title" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="project-description" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-6">
                                    <input type="text" name="description" id="project-description" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="project-status" class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" id="project-status" class="form-control">
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Create project
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection