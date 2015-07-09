@extends('layout.master')
@include('additional.navbar')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/dataTables.responsive.css') }}">
@stop
@section('content')
    <div class="container">
        <div class="col-sm-3">
            <div id="user-panel" class="panel panel-default animated fadeInLeft">
                <div class="panel-heading">Informasi Siswa</div>
                <div class="panel-body">
                    <img src="{{ asset('/images/user.png') }}" class="img-responsive img-circle center-block">
                    <br></br>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Nama</td><td>{{$siswa->nama}}</td>
                        </tr>
                        <tr>
                            <td>NIS</td><td>{{$siswa->nis}}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td><td>{{$siswa_tingkat->kd_rombel}}</td>
                        </tr>
                        <tr>
                            <td>Terlambat</td><td>{{count($absences)}}</td>
                        </tr>
                        <tr>
                            <td>Menit Terlambat</td><td>{{$sumMenit}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div id="user-table" class="panel panel-default animated fadeIn">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Absen</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tabel" class="table table-hover dt-responsive">
                            <thead>
                            <tr>
                                @foreach ($headers as $header)
                                    <td>{{$header}}</td>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($absences as $absence)
                                <tr>
                                    <?php
                                        $tahun_ajaran = DB::table('t_tahun_ajaran')
                                                ->where('kd_tahun_ajaran',$absence->kd_tahun_ajaran)
                                                ->first();
                                    ?>
                                    <td>{{$absence->hari}}</td>
                                    <td>{{$absence->tanggal}}</td>
                                    <td>{{$tahun_ajaran->tahun_ajaran}}</td>
                                    @if($absence->kd_periode_belajar=='1')
                                        <td>Ganjil</td>
                                    @else
                                        <td>Genap</td>
                                    @endif
                                    <td>{{$absence->jam_datang}}</td>
                                    <td>{{$absence->menit_kesiangan}}</td>
                                    <td>{{$absence->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dataTables.reponsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#tabel').DataTable({'dom':'<t><p>'});
        });
    </script>
@stop
@stop