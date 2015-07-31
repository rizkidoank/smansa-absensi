@extends('layout.master')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}">
@stop
@section('content')
    @include('additional.navbar')
    <div class="container">
    	<div class="col-md-6 col-md-offset-3">
            <div id="config-panel" class="panel panel-default animated fadeInLeft">
            	<div class="panel-heading">Piket</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam Masuk</th>
                                <th>Penanggung Jawab</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($piket as $p)
                                <tr>
                                    <td>{{$p->hari}}</td>
                                    <td>{{$p->jam_masuk}}</td>
                                    <td>{{\DB::table('t_guru')->where('kd_guru',$p->kd_guru)->first()->nm}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a class="btn btn-primary form-control" data-toggle="modal" href="#modal-id">Ubah</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Penanggung Jawab</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['class'=>'form-horizontal']) !!}
                    @foreach($piket as $p)
                        <fieldset>
                            <div class="form-group">
                                {!! Form::label('hari',$p->hari,['class'=>'control-label col-md-2']) !!}
                                <div class="col-md-5">
                                    <div class='input-group date' id={{'time'.$p->id}}>
                                        <input name="{{'time'.$p->id}}" type='text' class="form-control text-center" value="{{$p->jam_masuk}}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <select name="{{'guru'.$p->id}}" id="hari_{{$p->id}}" class="form-control">
                                        @foreach($guru as $g)
                                            @if($g->kd_guru == $p->kd_guru)
                                                <option value="{{$g->kd_guru}}" selected>{{$g->nm}}</option>
                                            @else
                                                <option value="{{$g->kd_guru}}">{{$g->nm}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    @endforeach

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!!Form::submit('Simpan',['class'=>'btn btn-primary'])!!}
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('/js/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
@stop