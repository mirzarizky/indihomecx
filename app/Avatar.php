<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatars';

    protected $fillable = [
        'name',
        'path'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
