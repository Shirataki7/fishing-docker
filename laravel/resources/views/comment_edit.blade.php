@extends('layouts.base')
@section('content')
    {{-- コメント入力欄 --}}
    <div class="comment_form">
    {{Form::open(['route'=>['comment_update',$comment->id]])}}
    {{Form::label('comment','コメント修正')}}<br/>
    {{Form::text('comment',old('comment',$comment->comment))}}
    {{-- {{Form::hidden('fish_record_id', $comment->fish_records->id)}} --}}
    {{Form::submit('送信')}}
    {{Form::close()}}
    </div>
@endsection