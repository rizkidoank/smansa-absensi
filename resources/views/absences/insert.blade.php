@extends('layout.master')
@section('content')
    @include('additional.navbar')
    <div class="container">
        <div class="panel panel-default animated slideInDown">
            <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
                @include('additional.errors')
                {!! Form::open(['class'=>'form']) !!}
                <div class="form-group col-md-3">
                    {!! Form::label('hari','Hari',['class'=>'control-label']) !!}
                    {!! Form::text('hari',$date->format('l'),['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('tgl','Tanggal',['class'=>'control-label']) !!}
                    {!! Form::date('tgl',$date,['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('jam_datang','Jam datang',['class'=>'control-label']) !!}
                    {!! Form::text('jam_datang',$date->format('H:m:s'),['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('menit_kesiangan','Menit kesiangan',['class'=>'control-label']) !!}
                    {!! Form::text('menit_kesiangan',$date->diffInMinutes($jam_masuk),['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('nis','NIS',['class'=>'control-label']) !!}
                    {!! Form::text('nis',$siswa->nis,['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('nama','Nama',['class'=>'control-label']) !!}
                    {!! Form::text('nama',$siswa->nama,['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('kelas','Kelas',['class'=>'control-label']) !!}
                    {!! Form::text('kelas',$siswa_tingkat->kd_rombel,['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-3">
                    {!! Form::label('guru_piket','Guru piket',['class'=>'control-label']) !!}
                    {!! Form::text('guru_piket',$piket->nama,['class'=>'form-control','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group col-md-12">
                    {!! Form::label('ket','Keterangan (wajib diisi)',['class'=>'control-label']) !!}
                    {!! Form::text('ket',"",['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-md-12">
                    {!! Form::hidden('kd_tahun_ajaran',$kd_tahun_ajaran) !!}
                    {!! Form::hidden('kd_periode_belajar',$kd_periode_belajar) !!}
                    {!! Form::submit('Kirim',['class'=>'form-control btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
