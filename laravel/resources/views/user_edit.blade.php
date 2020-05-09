@extends('layouts.base')
@section('stylesheet')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
@endsection
@section('content')
<div class="container">
    <div class="user_edit">
        <h3><i class="fas fa-user-edit"></i> プロフィール編集</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="user_edit_wraper">
            @if(!$user->user_image == null)
            <div class="img_block">
                <a href="{{$user->user_image}}" data-lightbox="group">
                    <img src="{{$user->user_image}}">
                </a>
            </div>
            @endif
            {{Form::open(['route'=>['user_update',$user['id']],'files'=>true])}}
            {{form::label('name','名前：')}}
            {{Form::text('name',old('name',$user->name))}}<br />
            {{Form::label('email','email：')}}
            {{Form::text('email',old('email',$user->email))}}<br />
            {{Form::label('description','自己紹介')}}<br />
            {{Form::textarea('description',old('description',$user->description),['rows'=>3,'cols'=>40])}}<br />
            {{Form::label('user_image','画像：')}}
            {{Form::file('user_image')}}<br />
            {{Form::submit('送信')}}
        </div>
    </div>
</div>
@endsection