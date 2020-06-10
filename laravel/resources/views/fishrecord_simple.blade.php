@extends('layouts.base')
@section('stylesheet')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="form_wrapper">
        <div class="form">
            <h3><i class="fas fa-pencil-alt"></i> 釣り記録投稿</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="preview">
                <img class="preview-cover" alt="" src="" style="height: 200px;" />
            </div>
            
            {{Form::open(['action'=>'FishRecordController@create','files'=>true,'class'=>'open_form'])}}
            <div class='form-row'>
                {{ Form::label('fish_image','画像',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::file('fish_image',['class'=>'form-control-file'])}}
                </div>
                {{{ Form::label('fishing_date', '釣行日',['class'=>'col-form-label']) }}}
                <div class="col">
                    {{ Form::date('fishing_date',\Carbon\Carbon::now(),['class'=>'form-control']) }}
                </div>               
            </div>
            <div class='form-row '>
                {{ Form::label('harbor','釣行先',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('harbor',null,['class'=>'form-control'])}}
                </div>
                {{ Form::label('ship','船宿',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('ship',null,['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('fish_name','釣った魚',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('fish_name',null,['class'=>'form-control'])}}
                </div>

                {{ Form::label('size','サイズ',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('size',null,['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('other_fish','外道(本命じゃない魚)',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('other_fish',null,['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('memo','メモ',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::textarea('memo',null,['class'=>'form-control'])}}
                </div>
            </div>
            <div class="text-right">
                {{ Form::submit('送信',['class'=>'btn btn-dark'])}}
                {{ Form::close()}}
            </div>
            <div class="text-center">
                {{-- 戻るボタン --}}
                {{Form::open(['route'=>'new','method'=>'get'])}}
                {{Form::submit('戻る',['class'=>'btn btn-secondary'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
<script>
    $('form').on('change', 'input[type="file"]', event => {
        const file = event.target.files[0]
        const reader = new FileReader()
        const $preview = $('.preview-cover'); // 表示する所
        // 画像ファイル以外は処理停止
        if (file.type.indexOf("image") < 0) {
            return false;
        }
        // ファイル読み込みが完了した際に発火するイベントを登録
        reader.onload = function (event) {
            // .prevewの領域の中にロードした画像を表示
            $preview.attr('src', event.target.result);
        };
        reader.readAsDataURL(file);
    })
</script>
@endsection