<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKriteria extends Model
{
    protected $table = 'detail_kriteria';

    protected $fillable = [
        'kriteria_id',
        'survei_id'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function kriteria() {
        return $this->hasOne('App\Kriteria', 'id', 'kriteria_id');
    }

    public function survei() {
        return $this->hasOne('App\Survei', 'id', 'survei_id');
    }
}
