@extends('layouts.base')
@section('content')
<div class='container'>
    <div class="form_wrapper">
        <div class="form">
            <h3><i class="fas fa-pencil-alt"></i> 釣り記録修正</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class='form_image'>
            <img src='{{$rec->fish_image}}'>
            </div>
            {{Form::open(['route'=>['update',$rec['id']],'files'=>true,'class'=>'open_form'])}}
            <div class='form-row'>
                {{{ Form::label('fishing_date', '釣行日',['class'=>'col-form-label']) }}}
                <div class="col">
                    {{ Form::date('fishing_date',old('fishing_date',$rec->fishing_date),['class'=>'form-control']) }}
                </div>

                {{ Form::label('harbor','釣行先',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('harbor',old('harbor',$rec->harbor),['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('ship','船宿',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('ship',old('ship',$rec->ship),['class'=>'form-control'])}}
                </div>

                {{ Form::label('fish_name','釣った魚',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('fish_name',old('fish_name',$rec->fish_name),['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('size','サイズ',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('size',old('size',$rec->size),['class'=>'form-control'])}}
                </div>

                {{ Form::label('other_fish','外道',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('other_fish',old('other_fish',$rec->other_fish),['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ form::label('weather','天気',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::select('weather',[''=>'選択してください','晴れ'=>'晴れ','曇り'=>'曇り','雨'=>'雨'],old('weather',$rec->weather),['class'=>'form-control'])}}
                </div>

                {{ Form::label('temperature','気温',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::selectRange('temperature',0,40,old('temperature',$rec->temperature), ['placeholder' => '&#8451;','class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('depth','棚',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::selectRange('depth',5,100,old('depth',$rec->depth), ['placeholder' => 'm','class'=>'form-control'])}}
                </div>

                {{ Form::label('tool','仕掛け',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('tool',old('tool',$rec->tool),['class'=>'form-control'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('tackle','タックル',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::text('tackle',old('tackle',$rec->tackle),['class'=>'form-control'])}}
                </div>

                {{ Form::label('fish_image','画像',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::file('fish_image',['class'=>'form-control-file'])}}
                </div>
            </div>
            <div class='form-row '>
                {{ Form::label('memo','メモ',['class'=>'col-form-label'])}}
                <div class="col">
                    {{ Form::textarea('memo',old('memo',$rec->memo),['class'=>'form-control'])}}
                </div>
            </div>
            <div class="text-right">
                {{ Form::submit('送信',['class'=>'btn btn-dark'])}}
                {{ Form::close()}}
            </div>
            <div class="text-center">
                {{-- 戻るボタン --}}
                {{Form::open(['route'=>'list','method'=>'get'])}}
                {{Form::submit('戻る',['class'=>'btn btn-secondary'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@endsection