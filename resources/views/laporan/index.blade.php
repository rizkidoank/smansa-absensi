@extends('layout.master')
@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.responsive.css') }}">
@stop
@section('content')
    @include('additional.navbar')
    <div class="container">
        <div id="laporan-panel" class="panel panel-default animated fadeInLeft">
            <div class="panel-heading">
                <h3 class="panel-title">Detail Absen</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    {!! Form::open() !!}
                    <div class="form-group col-sm-2">
                        {!! Form::text('nis',null,['class'=>'form-control','id'=>'nisSearch','placeholder'=>'NIS']) !!}
                    </div>
                    <div class="form-group col-sm-2">
                        <select name="kelas" id="kelasSearch" class="form-control">
                            <option value="">Semua</option>
                            @foreach($kelas as $kls)
                                <option value="{{$kls->kd_rombel}}">{{$kls->kd_rombel}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <select name="kd_tahun_ajaran" id="tahunAjaranSearch" class="form-control">
                            <option value=""></option>
                            @foreach($tahun_ajaran as $thn)
                                <option value="{{$thn->kd_tahun_ajaran}}">{{$thn->tahun_ajaran}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <select name="kd_periode_belajar" id="periodeSearch" class="form-control">
                            <option value="">Semua</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        {!! Form::text('tgl',\Date::now()->toDateString(),['class'=>'form-control','id'=>'tgl','placeholder'=>'Tanggal']) !!}
                    </div>
                    <div class="form-group col-sm-1">
                        {!! Form::submit('PDF',['class'=>'btn btn-primary form-control','name'=>'pdf']) !!}
                    </div>
                    <div class="form-group col-sm-1">
                        {!! Form::submit('Excel',['class'=>'btn btn-primary form-control','name'=>'excel']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="table-responsive">
                    <table class="table table-hover dt-responsive" id="tabel">
                        <thead>
                        @foreach ($headers as $header)
                            <th>{{$header}}</th>
                        @endforeach
                        </thead>
                        <tbody>
                        @foreach ($absens as $absence)
                            <tr>
                                <?php
                                $siswa = DB::table('t_siswa')->where('nis',$absence->nis)->first();
                                $guru = DB::table('t_guru')->where('kd_guru',$absence->kd_piket)->first();
                                $tahun_ajaran = DB::table('t_tahun_ajaran')->where('kd_tahun_ajaran',$absence->kd_tahun_ajaran)->first();
                                ?>
                                <td><a href="/home/student/{{$absence->nis}}">{{$absence->nis}}</a></td>
                                <td>{{$siswa->nama}}</td>
                                <td>{{$absence->kd_rombel}}</td>
                                <td>{{$tahun_ajaran->tahun_ajaran}}</td>
                                @if($absence->kd_periode_belajar=='1')
                                    <td>Ganjil</td>
                                @else
                                    <td>Genap</td>
                                @endif
                                <td>{{$absence->hari}}</td>
                                <td>{{$absence->tanggal}}</td>
                                <td>{{$absence->jam_datang}}</td>
                                <td>{{$absence->menit_kesiangan}}</td>
                                <td>{{$guru->nama}}</td>
                                <td>{{$absence->keterangan}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.js') }}"></script>
@stop