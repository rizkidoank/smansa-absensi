@extends('layout.master')

@section('content')
    @include('additional.navbar')
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <h1 id="clock" class="text-center animated fadeIn"></h1>
            <div id="add-panel" class="panel panel-default animated fadeInDown">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Data Kesiangan</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('tanggal','Tanggal',['class'=>'control-label']) !!}
                        {!! Form::date('tanggal',Date::now(),['class'=>'form-control','readonly'=>'readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('nis','NIS',['class'=>'control-label']) !!}
                        {!! Form::text('nis',null,['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Tambah catatan',['class'=>'form-control btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
