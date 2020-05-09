@extends('layouts.base')
@section('content')
<div class="container">
    <div class="notice_form">
        <div class="friend_form_box">
            <h3><i class="fas fa-check"></i> 通知</h3>
            @if($comments->count()>0)
            @foreach($comments as $comment)
            <a href="{{route('comment_state',$comment->id)}}">新しいコメントがつきました！　</a>{{$comment->created_at}}<br>
            @endforeach
            @else
            <p>新しいコメントはありません</p>
            @endif

            @if($friends->count()>0)
            @foreach ($friends as $friend)
            <a href="{{route('friend_state',$friend->id)}}">{{$friend->user->name}}さんがあなたをフレンドに登録しました！　</a>{{$friend->created_at}}<br>
            @endforeach
            @endif
        </div>
    </div>
</div>

@endsection