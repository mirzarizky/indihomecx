<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    protected $table = 'survei';

    protected $fillable = [
        'nilai',
        'komentar',
        'pesanan_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function pesanan() {
        return $this->hasOne('App\Pesanan', 'id', 'pesanan_id');
    }
}
