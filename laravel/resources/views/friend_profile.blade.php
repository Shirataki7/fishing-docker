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
    <div class="friend_form">
        <div class="friend_profile_box">
            <h4>{{$user->name}}</h4>
            @if(!$user->user_image==null)
            <a href="https://s3-ap-northeast-1.amazonaws.com/tsurins-images/{{$user->user_image}}"
                data-lightbox="group">
                <img src="https://s3-ap-northeast-1.amazonaws.com/tsurins-images/{{$user->user_image}}"></a><br />
            @endif
            性別：{{$user->sex}}<br />
            登録日：{{$user->created_at}}<br />
            自己紹介：{{$user->description}}<br />
            {{-- 投稿の表示 --}}
            <div class="rec_list">
                @if(count($user->fish_records)>0)
                @foreach ($user->fish_records as $rec)
                <div class="rec_table detalis" data-href="{{route('detalis', ['id' => $rec['id']])}}">
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
                            @else
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
                            <div class="rec_image">
                                @if($rec['fish_image'] != null)
                                <img
                                    src="https://s3-ap-northeast-1.amazonaws.com/tsurins-images/{{$rec['fish_image']}}">
                                @else
                                <img src="{{asset('/images/no_image.jpg')}}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="rec_foot">
                        <div class="rec_element">
                            <p>気温 / {{$rec['temperature']}}&#8451;</p>
                            <p>棚 / {{$rec['depth']}}m</p>
                        </div>
                        <div class="rec_btn">
                            @if($rec->user_id == Auth::id())
                            <div class='twitter_shere'>
                                <a href='http://twitter.com/share?url=http://www.tsurins.com/fish_records/{{$rec->id}}
                                    &text=釣り記録を投稿しました！%0a{{$rec->harbor}}で{{$rec->fish_name}}を釣ったよ！
                                    &hashtags=TSURINS,fishing,釣り,釣り人&via=tsurins_info' target='_blank'
                                    rel='noopener noreferrer'><i class="fab fa-twitter"></i></a>
                            </div>
                            <div class="rec_edit">
                                {{Form::open(['method'=>'get','route'=>['edit',$rec['id']]])}}
                                {{Form::submit('修正',['name'=>'edit[]'],$rec['id'])}}
                                {{Form::close()}}
                            </div>
                            <div class="rec_delete">
                                {{Form::open(['route'=>['delete',$rec['id']]])}}
                                {{Form::submit('削除',['name'=>'delete[]','class'=>'delete'],$rec['id'])}}
                                {{Form::close()}}
                            </div>
                            @elseif($rec->user_id != Auth::id() || Auth::id() == null)
                            <div class='twitter_shere'>
                                <a href='http://twitter.com/share?url=http://www.tsurins.com/fish_records/{{$rec->id}}
                                &text={{$rec->user->name}}さんの釣った{{$rec->fish_name}}がすごい！
                                    &hashtags=TSURINS,fishing,釣り,釣り人&via=tsurins_info' target='_blank'
                                    rel='noopener noreferrer'><i class="fab fa-twitter"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>釣り記録がありません。</p>
                @endif
            </div>

        </div>
        <div class="text-center">
            {{-- フレンド解除ボタン --}}
            @if($is_friend)
            {{Form::open(['route'=>['friend_delete',$user->id]])}}
            {{ method_field('delete') }}
            {{Form::submit('フレンド解除')}}
            {{Form::close()}}
            @elseif(!$is_friend && $user->id!=Auth::id() && !Auth::id() == null)
            {{-- フレンド追加ボタン --}}
            {{Form::open(['route'=>'add_friend'])}}
            {{Form::hidden('friend_id',$user->id)}}
            {{Form::submit('フレンドになる',['name'=>'friend_btn'])}}
            {{Form::close()}}
            @endif
            <br />
            {{-- 戻るボタン --}}
            {{Form::open(['route'=>'friend_list','method'=>'get'])}}
            {{Form::submit('戻る',['class'=>'return btn'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
</div>
@endsection