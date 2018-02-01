<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
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
}
