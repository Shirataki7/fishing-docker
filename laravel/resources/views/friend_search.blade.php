@extends('layouts.base')
@section('content')
<div class="container">
    <div class="friend_form">
        <div class="friend_form_box">
            <h3><i class="fas fa-search"></i> フレンド検索結果</h3>
            <p>{{count($friend_user)}}人のユーザーが見つかりました</p>
            @foreach ($friend_user as $friend)
            @if(!$friend->user_image==null)
            <img src="{{$friend->user_image}}">
            @endif
            {{-- 他ユーザープロフィール作る --}}
            <a href="{{route('friend_profile',$friend->id)}}">{{$friend->name}}</a>
            {{$friend->description}}<br/>
            {{Form::open(['route'=>'add_friend'])}}
            {{Form::hidden('friend_id',$friend->id)}}
            {{Form::submit('フレンドになる',['name'=>'friend_btn'])}}
            {{Form::close()}}<br />
            <div class="border_switch"></div>
            @endforeach
            {{-- 戻るボタン --}}
            {{Form::open(['url'=>'mypage/search_friends','method'=>'get'])}}
            {{Form::submit('戻る',['class'=>'return btn'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection