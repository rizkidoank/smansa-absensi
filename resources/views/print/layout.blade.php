<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keterlambatan Siswa</title>
</head>

<body style="font-family: 'Times New Roman'">

<div style="text-align: center">
    <h1>SMA Negeri 1 Cianjur</h1>
    <p>
        Jl. Pangeran Hidayatulloh No.62, Cianjur <br/>
        Jawa Barat 43212, Indonesia <br/>
        Tel : +62 263 261295
    </p>
    <hr/>
    <h2>LAPORAN KETERLAMBATAN SISWA</h2>
    @if($tanggal != '')
        <p>Tanggal : {{ $tanggal }}</p>
    @endif
    <br/>
</div>
    @include('print.table')
</body>
</html>

