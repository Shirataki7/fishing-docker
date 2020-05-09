@extends('layouts.base')
@section('content')
<div class="container">
    <div class="friend_form">
        <div class="friend_form_box">
            <h3><i class="fas fa-search"></i> フレンド検索</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{Form::open(['route'=>'search_friend'])}}
            {{Form::label('name','名前で検索：')}}
            {{Form::text('name')}}
            {{Form::submit('検索')}}
            {{Form::close()}}
            @if (session('flash_message'))
            <div class="flash_message">
                {{ session('flash_message') }}
            </div>
            @endif
            {{-- 戻るボタン --}}
            {{Form::open(['route'=>'user','method'=>'get'])}}
            {{Form::submit('戻る',['class'=>'return btn'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection