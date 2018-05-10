<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berkas extends Model
{
    use SoftDeletes;

    protected $table = 'berkas';

    protected $fillable = [
        'nama',
        'path',
        'tanggalMulaiPesanan',
        'tanggalAkhirPesanan',
        'totalNoHp',
        'totalEmail',
        'totalPesanan',
        'berkasStatus'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function pesanan() {
        return $this->hasMany('App\Pesanan', 'berkas_id', 'id');
    }
}
