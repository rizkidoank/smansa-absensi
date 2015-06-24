<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_kesiangan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nis',10);
            $table->char('kd_tahun_ajaran',2);
            $table->char('kd_periode_belajar',1);
            $table->string('kd_rombel',15);
            $table->string('hari');
            $table->date('tanggal');
            $table->time('jam_datang');
            $table->integer('menit_kesiangan');
            $table->string('kd_piket',5);
            $table->string('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_kesiangan');
    }
}
