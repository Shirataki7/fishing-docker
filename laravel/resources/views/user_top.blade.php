@extends('layouts.base')
@section('stylesheet')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/fish_records.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="user_contents">
        <div class="top_grid">
            <a href="{{ url('/fish_records/new') }}"><i class="fas fa-pencil-alt"></i> 釣り記録投稿</a>
            <a href="{{ url('/fish_records') }}"><i class="fas fa-clipboard-list"></i> 釣り記録一覧</a>
        </div>
        <div class="second_grid">
            <a href="{{route('user_edit')}}"><i class="fas fa-user-edit"></i> プロフィール編集 </a>
            <a href="{{url('mypage/search_friends')}}"><i class="fas fa-search"></i> フレンド検索</a>
            <a href="{{url('mypage/friends')}}"><i class="far fa-address-book"></i> フレンド一覧</a>
        </div>
    </div>
    <div class="timeline">
        <h3>FRIEND TIME LINE <i class="far fa-comment-dots"></i></h3>
        <div class="rec_top_list">
            @if(isset($friend_records))
            @foreach($friend_records as $rec)
            <div class="rec_top_table detalis" data-href="{{route('detalis', ['id' => $rec['id']])}}">
                <div class="rec_head head_top">
                    <div class="rec_head_element">
                        <p><a href="{{route('friend_profile',$rec->user->id)}}">{{$rec->user->name}}</a></p>
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
                        <div class="rec_image">
                            @if($rec['fish_image'] != null)
                            <img src="{{$rec['fish_image']}}">
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
                            {{Form::open(['route'=>['edit',$rec['id']]])}}
                            {{Form::submit('修正',['name'=>'edit[]'],$rec['id'])}}
                            {{Form::close()}}
                        </div>
                        <div class="rec_delete">
                            {{Form::open(['route'=>['delete',$rec['id']]])}}
                            {{ method_field('delete') }}
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
            @endif
        </div>
    </div>
</div>
</div>
@endsection