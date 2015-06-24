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
        return view('home');
    }

    public function postHome(Request $request){
        $this->validate($request,[
            'nis'=>'required'
        ]);
        return redirect('home/tambahAbsen')->withInput();//redirect('home/tambahAbsen');
    }

    public function getInsert(){
        if(Input::old('tanggal')!="" and Input::old('nis')!="") {
            $siswa = \DB::table('t_siswa')->where('nis',Input::old('nis'));
            if($siswa->count()==0)
                return redirect('/home');
            else
                $siswa=$siswa->first();
            $date = Date::createFromFormat('Y-m-d',Input::old('tanggal'));
            if($date->month>=1 and $date->month<=6) {
                $siswa_tingkat = \DB::table('t_siswa_tingkat')
                    ->where('nis', Input::old('nis'))
                    ->where('kd_tahun_ajaran',20)
                    ->where('kd_periode_belajar',2)
                    ->first();
                $kd_tahun_ajaran = '20';
                $kd_periode_belajar = '2';
            } else{
                $siswa_tingkat = \DB::table('t_siswa_tingkat')
                    ->where('nis', Input::old('nis'))
                    ->where('kd_tahun_ajaran',21)
                    ->where('kd_periode_belajar',1)
                    ->first();
                $kd_tahun_ajaran = '21';
                $kd_periode_belajar = '1';
            }
            $pikets = \DB::table('t_piket')->where('hari',$date->format('l'))->first();
            $piket = \DB::table('t_guru')->where('kd_guru',$pikets->kd_guru)->first();
            $jam_masuk = Date::createFromFormat('H:i:s',$pikets->jam_masuk,Date::now()->tzName);
            return view('absences.insert',compact(
                'date',
                'jam_masuk',
                'siswa',
                'siswa_tingkat',
                'piket',
                'kd_tahun_ajaran',
                'kd_periode_belajar'
            ));
        }
        else
            return redirect('home');
    }

    public function postInsert(Request $request){
        $this->validate($request,[
            'ket'=>'required',
        ]);
        $absen = new Absence();
        $piket = \DB::table('t_guru')->where('nama',$request->guru_piket)->first();
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
        return redirect('home');
    }

    public function getConfig(){
        $piket = \DB::table('t_piket')->orderBy('id','asc')->get();
        $guru = \DB::table('t_guru')->where('status','1')->orderBy('kd_guru')->get();
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
}
