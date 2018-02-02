<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $table = 'berkas';

    protected $fillable = [
        'nama',
        'path',
        'tanggalMulaiPesanan',
        'tanggalAkhirPesanan',
        'totalNoHp',
        'totalEmail',
        'isSent'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function pesanan() {
        return $this->hasMany('App\Pesanan', 'berkas_id', 'id');
    }
}
