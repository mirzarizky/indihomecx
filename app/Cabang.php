<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';

    protected $fillable = [
        'kode',
        'nama'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

}
