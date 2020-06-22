@extends('layouts.base')
@section('stylesheet')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
<script src="{{ asset('/js/comment.js') }}"></script>
<script src="{{ asset('js/fish_records.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="rec_detalis_list">
        <div class="rec_detalis_image">
            @if($rec['fish_image'] != null)
            <a href="{{$rec['fish_image']}}" data-lightbox="group"><img src="{{$rec['fish_image']}}"></a>
            @else
            <img src="{{asset('/images/no_image.jpg')}}">
            @endif
        </div>
        <div class="rec_detalis_table">
            <div class="rec_head head_top">
                <div class="rec_head_element">
                    <p>{{$rec['fish_name']}}</p>
                    <p>{{$rec['size']}}
                        @if($rec['size'] != null)
                        cm</p>
                    @endif
                    <p>/</p>
                    <p>{{$rec['fishing_date']}}</p>
                </div>
            </div>
            <div class="rec_head head_second">
                <div class="rec_head_element">
                    <p>{{$rec['harbor']}}</p>
                    <p>{{$rec['ship']}}</p>
                    {{-- 天気をアイコンで表示 --}}
                    @if($rec['weather'] == '晴れ')
                    <p><i class="fas fa-sun"></i></p>
                    @elseif($rec['weather'] == '曇り')
                    <p><i class="fas fa-cloud"></i></p>
                    @elseif($rec['weather'] == '雨')
                    <p><i class="fas fa-umbrella"></i></p>
                    @endif

                </div>
            </div>
            <div class="rec_body">
                <div class="rec_inner">
                    <div class="rec_memo">
                        <p>{{$rec['tool']}}/{{$rec['tackle']}}</p>
                        {{$rec['memo']}}
                    </div>

                </div>
            </div>
            <div class="rec_foot">
                <div class="rec_element">
                    <p>気温 / {{$rec['temperature']}}&#8451;</p>
                    <p>棚 / {{$rec['depth']}}m</p>
                </div>
                <div class="rec_btn">
                    <div class='twitter_shere'>
                        <a href='http://twitter.com/share?url=http://www.tsurins.com/fish_records/{{$rec->id}}
                            &text=釣り記録を投稿しました！%0a{{$rec->harbor}}で{{$rec->fish_name}}を釣ったよ！
                            &hashtags=TSURINS,fishing,釣り,釣り人&via=tsurins_info' target='_blank'
                            rel='noopener noreferrer'><i class="fab fa-twitter"></i></a>
                    </div>
                    @if($rec->user_id == Auth::id())
                    <div class="rec_edit">
                        {{Form::open(['method'=>'get','route'=>['edit',$rec['id']]])}}
                        {{Form::submit('修正',['name'=>'edit[]'],$rec['id'])}}
                        {{Form::close()}}
                    </div>
                    <div class="rec_delete">
                        {{Form::open(['route'=>['delete',$rec['id']]])}}
                        {{ method_field('delete') }}
                        {{Form::submit('削除',['name'=>'delete[]','class'=>'delete'],$rec['id'])}}
                        {{Form::close()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <h4 class="comment_h"><i class="far fa-comments"></i> コメント</h4>
        <div class="comment">
            {{-- コメント欄 --}}
            @foreach($rec->comments as $comment)
            <div class="comment_view">
                <div class="comment_show">
                    <a href="{{route('friend_profile',$comment->user->id)}}">{{$comment->user->name}}</a> /
                    {{$comment->comment}}
                    {{$comment->created_at}}<br />
                </div>

                @if($comment->user_id == Auth::id())
                <div class="comment_btn">
                    <div class="rec_edit">
                        {{Form::open(['route'=>['comment_edit',$comment->id]])}}
                        {{Form::submit('修正',['name'=>'comment_edit[]'],$comment->id)}}
                        {{Form::close()}}
                    </div>
                    <div class="rec_delete">
                        {{Form::open(['route'=>['comment_delete',$comment->id]])}}
                        {{ method_field('delete') }}
                        {{Form::submit('削除',['name'=>'comment_delete[]','class'=>'comment_delete'],$comment->id)}}
                        {{Form::close()}}
                    </div>
                </div>

                @endif
            </div>
            @endforeach

            <div class="comment_form">
                {{-- コメント入力欄 --}}
                {{Form::open(['route'=>['comment',$rec['id']]])}}
                {{Form::text('comment',null,['placeholder'=>'コメントする'])}}
                {{Form::hidden('fish_record_id', $rec['id'])}}
                {{Form::submit('送信',['class'=>'add_comment'])}}
                {{Form::close()}}

                @if (session('flash_message'))
                <div class="flash_message">
                    {{ session('flash_message') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="text-center">
        {{-- 戻るボタン --}}
        @if($rec->user_id == Auth::id())
        {{Form::open(['route'=>'list','method'=>'get'])}}
        {{Form::submit('戻る')}}
        {{Form::close()}}
        @else
        {{Form::open(['route'=>'friend_list','method'=>'get'])}}
        {{Form::submit('戻る',['class'=>'return btn'])}}
        {{Form::close()}}
        @endif
    </div>
</div>
@endsection