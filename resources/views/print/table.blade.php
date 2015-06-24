<div>
    <table style="width: 100%;border: 1px solid #000000; border-collapse: collapse; border-spacing: 0;font-size: normal;page-break-after: auto">
        <thead>
        <tr>
            @foreach($headers as $header)
                <th style="border: 1px solid #000000;padding:5;">{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($absences as $absence)
            <?php
            $siswa = DB::table('t_siswa')->where('nis',$absence->nis)->first();
            $kelas = DB::table('t_siswa_tingkat')->where('nis',$siswa->nis)->first();
            $tahun_ajaran = DB::table('t_tahun_ajaran')->where('kd_tahun_ajaran',$absence->kd_tahun_ajaran)->first();
            $piket = \DB::table('t_guru')->where('kd_guru',$absence->kd_piket)->first();
            if($absence->kd_periode_belajar=='1')
                $absence->kd_periode_belajar='Ganjil';
            else
                $absence->kd_periode_belajar='Genap';
            ?>
            <tr>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->nis}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$siswa->nama}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->kd_rombel}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$tahun_ajaran->tahun_ajaran}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->kd_periode_belajar}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->hari}}, {{$absence->tanggal}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->jam_datang}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->menit_kesiangan}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$piket->nama}}</td>
                <td style="border: 1px solid #000000;padding:5;">{{$absence->keterangan}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<br/>
<div>
    <table style="text-align:right ;width: 100% ;font: bold">
        <tbody>
        <tr>
            <td;">Total Data</td>
            <td>{{ count($absences) }}</td>
        </tr>
        </tbody>
    </table>
</div>