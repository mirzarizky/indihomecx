<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'tanggal',
        'namaPelanggan',
        'noHpPelanggan',
        'emailPelanggan',
        'isSurvei',
        'status_kode',
        'cabang_kode',
        'berkas_id'
    ];

    protected $dates = [
        'tanggal', 'created_at', 'updated_at'
    ];

    public function status() {
        return $this->hasOne('App\Status', 'kode', 'status_kode');
    }

    public function cabang() {
        return $this->hasOne('App\Cabang', 'kode', 'cabang_kode');
    }

    public function berkas() {
        return $this->hasOne('App\Berkas', 'id', 'berkas_id');
    }

    public function survei() {
        return $this->hasOne('App\Survei', 'survei_id', 'id');
    }
}
