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

    public function status() {
        switch ($this->berkasStatus){
            case '1':
                return 'Proses ekstraksi';
                break;
            case '2':
                return 'Ekstraksi selesai';
                break;
            case '3':
                return 'Proses kirim email & sms';
                break;
            case '4':
                return 'Link terkirim';
                break;
            case '5':
                return 'File terhapus';
                break;
            default:
                return 'Berkas berhasil diupload';
                break;
        }
    }

    public function isStatus($kode_status) {
        if($kode_status == $this->berkasStatus) {
            return true;
        } else {
            return false;
        }
    }
}
