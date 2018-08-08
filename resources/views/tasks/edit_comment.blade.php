@extends('tasks.view')

@section('comments')
    <table class="table">
        <tbody>
        @foreach($task->comments as $comment)
            <tr>
                <td>{{ $comment->created_at }}</td>
                <th>{{ $comment->author->name }}</th>
                <td>













                    @if($edit_comment->id === $comment->id)
                        <form action="{{ route('edit_comment', ['id' => $comment->id]) }}" method="post" class="col-sm-12">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <textarea class="form-control" name="text" rows="3"> {{ $comment->text }} </textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">
                                Ok
                            </button>
                        </form>
                    @else
                        {{ $comment->text }}
                    @endif








                </td>
                {{--@if($edit_comment->id === $comment->id)
                <td>
                    <form action="{{ route('edit_comment', ['id' => $comment->id]) }}" method="post" class="col-sm-2">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger">
                            Ok
                        </button>
                    </form>
                </td>
                @endif--}}
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection