<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function getIndex(){
        $absens = \DB::table('t_kesiangan')->get();
        $tahun_ajaran = \DB::table('t_tahun_ajaran')->get();
        $kelas = \DB::table('t_siswa_tingkat')->distinct('kd_rombel')->orderBy('kd_rombel')->get(['kd_rombel']);
        $headers = ['NIS','Nama','Kelas','Tahun Ajaran','Periode Belajar','Hari','Tanggal','Jam Datang','Menit Kesiangan','Piket','Keterangan'];
        return view('laporan.index',compact('headers','absens','tahun_ajaran','kelas'));
    }

    public function getShow($nis){
        $siswa = \DB::table('t_siswa')->where('nis',$nis)->first();
        $siswa_tingkat = \DB::table('t_siswa_tingkat')->where('nis',$siswa->nis)->first();
        $absences = \DB::table('t_kesiangan')->where('nis',$siswa->nis)->get();

        $sumMenit = 0;
        $headers = ['Hari','Tanggal','Tahun Ajaran','Periode Belajar','Jam Datang','Menit Kesiangan','Keterangan'];
        foreach ($absences as $absence){
            $sumMenit += $absence->menit_kesiangan;
        }
        return view('laporan.show',compact('siswa','siswa_tingkat','absences','sumMenit','headers'));
    }

    public function exportLaporan(Request $request){
        $input = $request->all();
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
    public function getBanyak(){
        $count = \DB::table('t_kesiangan')
        ->select(\DB::raw('distinct `nis`'))->get();
        
        foreach ($count as $c) {
            echo $c->nis." - ".\DB::table('t_kesiangan')->where('nis',$c->nis)->count()."\n\n";
        }
        return "END";
    }
}
