@extends('layouts.base')
@section('stylesheet')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/fish_records.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="{{ asset('js/posts_chart.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="rec_search">
        <h3><i class="fas fa-clipboard-list"></i>　釣り記録一覧</h3>
        <div class="rec_search_box">
            @if(count($data)>0)

            <h4><i class="fas fa-search"></i> 記録検索</h4>
            {{Form::open(['route'=>'search','method'=>'GET'])}}
            {{ Form::label('fishing_date', '釣行日')}}
            {{ Form::date('fishing_date')}}
            {{ Form::submit('検索')}}
            <br />
            {{ Form::label('harbor','釣行先')}}
            {{ Form::text('harbor')}}
            {{ Form::submit('検索')}}
            <br />
            {{ Form::label('ship','船宿')}}
            {{ Form::text('ship')}}
            {{ Form::submit('検索')}}
            <br />
            {{ Form::label('fish_name','釣った魚')}}
            {{ Form::text('fish_name')}}
            {{ Form::submit('検索')}}
            <br />
            {{Form::close()}}
        </div>
        <div class ='chart'>
        <canvas id="p_chart"></canvas>
        </div>
    </div>

    <div class="rec_list">
        @foreach ($data as $rec)
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
                        {{ method_field('delete') }}
                        {{Form::submit('削除',['name'=>'delete[]','class'=>'delete'],$rec['id'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p>釣り記録がありません。</p>
        @endif
    </div>
    {{-- 戻るボタン --}}
    <div class="text-center">
        {{Form::open(['route'=>'user','method'=>'get'])}}
        {{Form::submit('戻る',['class'=>'return btn'])}}
        {{Form::close()}}
    </div>
</div>
@endsection