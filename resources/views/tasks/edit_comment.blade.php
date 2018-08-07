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
                    <div class="col-sm-12">
                        <input type="text" name="text" id="comment-text" value="{{ $comment->text }}" class="form-control">
                    </div>
                    @else
                        {{ $comment->text }}
                    @endif
                </td>
                <td>
                    {{--@if($request->user()->id === $comment->author->id)
                        <form action="{{ route('comment_delete', ['id' => $comment->id]) }}" method="get" class="col-sm-2">
                            --}}{{--{!! method_field('delete') !!}--}}{{--
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    @endif--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection