@extends('layouts.base')
@section('content')
<div class="container">
    <div class="friend_form">
        <div class="friend_form_box">
            <h3><i class="far fa-address-book"></i>　フレンド一覧</h3>
            @if(count($friends) > 0)
            @foreach($friends as $friend)
            @if(!$friend->user->user_image==null)
            <img src="https://s3-ap-northeast-1.amazonaws.com/aws.fish-records/{{$friend->user->user_image}}">
            @endif
            <a href="{{route('friend_profile',$friend->friend_id)}}">{{$friend->user->name}}</a>
            {{$friend->user->description}}<br/>
            @endforeach
            @else
            <p>フレンドがいません！</p>
            @endif
        </div>
        <div class="text-center">
            {{-- 戻るボタン --}}
            {{Form::open(['route'=>'user','method'=>'get'])}}
            {{Form::submit('戻る',['class'=>'return btn'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection