<?php

namespace App\Http\Controllers;

use App\Absence;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;

class AbsencesController extends Controller
{
    public function getHome(){
        Date::setLocale('id');
        $date = Date::now();
        $pikets = \DB::table('t_piket')->where('hari',$date->format('l'))->first();
        $piket = \DB::table('t_guru')->where('kd_guru',$pikets->kd_guru)->first();
        $jam_masuk = Date::createFromFormat('H:i:s',$pikets->jam_masuk,Date::now()->tzName)->toTimeString();
        return view('home',compact('jam_masuk'));
    }

    public function postHome(Request $request){
        $this->validate($request,[
            'nis'=>'required'
        ]);
        return redirect('home/tambahAbsen')->withInput();//redirect('home/tambahAbsen');
    }

    public function getInsert(){
        //if(Input::old('tanggal')!="" and Input::old('nis')!="") {
            $siswa = \DB::table('t_siswa_tingkat')->where('nis', Input::old('nis'))->first();

            if($siswa==null){
                \Session::flash('siswa_ilang','NIS tidak ditemukan');
                return redirect('/home');
            }
            $date = Date::createFromFormat('Y-m-d',Input::old('tanggal'));
            $tapel = AbsencesController::checkPeriode($date);
            $tapel['kd_tapel']= \DB::table('t_tahun_ajaran')
                ->where('tahun_ajaran',$tapel['tahun_ajaran'])
                ->first()->kd_tahun_ajaran;
            $siswa_tingkat = \DB::table('t_siswa_tingkat')
                    ->where('nis',$siswa->nis)
                    ->where('kd_tahun_ajaran',$tapel['kd_tapel'])
                    ->where('kd_periode_belajar',$tapel['periode'])->first();
            if($siswa_tingkat==null){
                \Session::flash('tahun_ajaran','Tahun ajaran belum dimulai');
                return redirect('/home');
            }
            $siswa = \DB::table('t_siswa')->where('nis',$siswa->nis)->first();
            $pikets = \DB::table('t_piket')->where('hari',$date->format('l'))->first();
            $piket = \DB::table('t_guru')->where('kd_guru',$pikets->kd_guru)->first();
            $jam_masuk = Date::createFromFormat('H:i:s',$pikets->jam_masuk,Date::now()->tzName);

            return view('absences.insert',compact(
                'date',
                'jam_masuk',
                'siswa',
                'siswa_tingkat',
                'piket',
                'tapel'
            ));
        //}
        //else
        //    return redirect('home');
    }

    public function postInsert(Request $request){
        if($request->get('ket')!="") {
            $absen = new Absence();
            $piket = \DB::table('t_guru')->where('nama', $request->guru_piket)->first();
            $absen->nis = $request->nis;
            $absen->kd_tahun_ajaran = $request->kd_tahun_ajaran;
            $absen->kd_periode_belajar = $request->kd_periode_belajar;
            $absen->kd_rombel = $request->kelas;
            $absen->hari = $request->hari;
            $absen->tanggal = $request->tgl;
            $absen->jam_datang = $request->jam_datang;
            $absen->menit_kesiangan = $request->menit_kesiangan;
            $absen->kd_piket = $piket->kd_guru;
            $absen->keterangan = $request->ket;
            $absen->save();
            \Session::flash('success','Data berhasil ditambahkan');
        }
        else{
            \Session::flash('error','Gagal tambah data, isi kolom keterangan');
        }
        return redirect('home');

    }

    public function getConfig(){
        $piket = \DB::table('t_piket')->orderBy('id','asc')->get();
        $guru = \DB::table('t_guru')->where('status','1')->orderBy('nm')->get();
        return view('absences.config',compact('piket','guru'));
    }

    public function postConfig(Request $request){
        $input = $request->all();
        for($i=1;$i<7;$i++){
            \DB::table('t_piket')
                ->where('id',$i)
                ->update([
                    'jam_masuk'=>\Input::get('time'.$i),
                    'kd_guru'=>\Input::get('guru'.$i)
                ]);
        }
        return redirect('/home/configuration');
    }

    public function checkPeriode(Date $date){
        $month = $date->month;
        $year = $date->year;
        if($month >= 1 and $month <= 6)
            return array(
                'tahun_ajaran'=>strval($year-1)."/".strval($year),
                'periode'=>'2');
        else if($month > 6 and $month <= 12)
            return array(
                'tahun_ajaran'=>strval($year)."/".strval($year+1),
                'periode'=>'1');
    }
}
