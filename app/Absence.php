<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table='t_kesiangan';
    protected $fillable=[
        'nis',
        'kd_tahun_ajaran',
        'kd_periode_belajar',
        'kd_rombel',
        'hari',
        'tanggal',
        'jam_datang',
        'menit_kesiangan',
        'kd_piket',
        'keterangan'
    ];
    public $timestamps=false;
}
