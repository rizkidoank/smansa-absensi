<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Jenssegers\Date\Date;

class LaporanController extends Controller
{
    public function getIndex(){
        $absens = \DB::table('t_kesiangan')->get();
        $kelas = \DB::table('t_siswa_tingkat')->distinct('kd_rombel')->orderBy('kd_rombel')->get(['kd_rombel']);
        $headers = ['NIS','Nama','Kelas','Tahun Ajaran','Semester','Hari','Tanggal','Jam Datang','Menit Kesiangan','Piket','Keterangan'];
        $date = Date::now();
        $th1 = strval($date->year-1)."/".strval($date->year);
        $th2 = strval($date->year)."/".strval($date->year+1);
        $t1 = \DB::table('t_tahun_ajaran')->where('tahun_ajaran',$th1)->get();
        $t2 = \DB::table('t_tahun_ajaran')->where('tahun_ajaran',$th2)->get();
        $tahun_ajaran =(object) array_merge((array)$t1,(array)$t2);
        return view('laporan.index',compact('headers','absens','tahun_ajaran','kelas'));
    }

    public function getShow($nis){
        $siswa = \DB::table('t_siswa')->where('nis',$nis)->first();
        $siswa_tingkat = \DB::table('t_siswa_tingkat')->where('nis',$siswa->nis)->first();
        $absences = \DB::table('t_kesiangan')->where('nis',$siswa->nis)->get();

        $sumMenit = 0;
        $headers = ['Hari','Tanggal','Tahun Ajaran','Semester','Jam Datang','Menit Kesiangan','Keterangan'];
        foreach ($absences as $absence){
            $sumMenit += $absence->menit_kesiangan;
        }
        return view('laporan.show',compact('siswa','siswa_tingkat','absences','sumMenit','headers'));
    }

    public function exportLaporan(Request $request){
        $input = $request->all();
        if($input['kd_periode_belajar']=='Ganjil')
            $input['kd_periode_belajar']='1';
        else
            $input['kd_periode_belajar']='2';
        $headers = ['NIS','Nama','Kelas','Tahun Ajaran','Periode Belajar','Hari/Tanggal','Jam Datang','Menit Kesiangan','Piket','Keterangan'];
        $absences = \DB::table('t_kesiangan')
            ->where('tanggal','like',$input['tgl'].'%')
            ->where('nis','like',$input['nis'].'%')
            ->where('kd_rombel','like',$input['kelas'].'%')
            ->where('kd_tahun_ajaran','like',$input['kd_tahun_ajaran'].'%')
            ->where('kd_periode_belajar','like',$input['kd_periode_belajar'].'%')
            ->get();
        if($input['tgl']=='')
            $tanggal = 'All';
        else
            $tanggal = $input['tgl'];
        if(Input::get('pdf')){
            $pdf = \PDF::loadView('print.layout',compact('headers','absences','tanggal'))->setPaper('a4')->setOrientation('landscape');
            return $pdf->stream();
        }
        elseif(Input::get('excel')){
            $data = compact('headers','absences','tanggal');
            $title ='Kesiangan_'.$data['tanggal'];
            return Excel::create($title,function($excel) use ($data){
                $excel->setTitle('Laporan Keterlambatan Siswa');
                $excel->setCreator('Admin')->setCompany('SMAN 1 Cianjur');
                $excel->sheet('Laporan Siswa Kesiangan', function($sheet) use ($data) {
                    $sheet->loadView('print.table',$data);
                    $sheet->setAutoSize(true);
                });

            })->export('xlsx');
        }
    }
    public function checkPeriode(Date $date){
        $month = $date->month;
        $year = $date->year;
        if($month >= 1 and $month <= 6)
            return array(
                'tahun_ajaran'=>strval($year-1)."/".strval($year),
                'periode'=>'2');
        else if($month >= 6 and $month <= 12)
            return array(
                'tahun_ajaran'=>strval($year)."/".strval($year+1),
                'periode'=>'1');
    }
}
