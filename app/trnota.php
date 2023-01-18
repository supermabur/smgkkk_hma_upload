<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trnota extends Model
{
    public $timestamps = false;
    protected $table = 'trnota';

    protected $fillable = [
        'id',
        'tanggal',
        'kdproject',
        'jenis',
        'nota'
    ];
}
