@extends('layout.auth')

@section('title')
    Form Masuk
@stop

@section('form')
    @include('additional.errors')
    {!! Form::open() !!}
    <div class="form-group">
        {!! Form::label('username','Username',['class'=>'control-label']) !!}
        {!! Form::text('username',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password','Password',['class'=>'control-label']) !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <hr/>
    {!! Form::submit('Kirim',['class'=>'form-control btn btn-success']) !!}
    {!! Form::close() !!}
@stop