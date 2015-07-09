@extends('layout.master')

@section('content')
    @include('additional.navbar')
    <div class="container">
        <div class="col-md-3">
            @if(Session::has('login_flash'))
                <div class="alert alert-success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Notification</strong><br/>
                        {{Session::get('login_flash')}}
                </div>
            @endif
            @if(Session::has('tahun_ajaran'))
                <div class="alert alert-danger" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Notification</strong><br/>
                        {{Session::get('tahun_ajaran')}}
                </div>
            @endif
            @if(Session::has('siswa_ilang'))
                <div class="alert alert-success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Notification</strong><br/>
                    {{Session::get('siswa_ilang')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Notification</strong><br/>
                    {{Session::get('error')}}
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Notification</strong><br/>
                    {{Session::get('success')}}
                </div>
            @endif
        </div>
        <div class="col-md-4 col-md-offset-1">
            <h1 id="clock" class="text-center animated fadeInDown"></h1>
            <h3 id="timer" class="text-center animated fadeInDown">{{$jam_masuk}}</h3>
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
                        {!! Form::text('nis',null,['class'=>'form-control','required'=>'true']) !!}
                    </div>
                    {!! Form::submit('Tambah catatan',['class'=>'form-control btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
