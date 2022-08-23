<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ongkos extends Model
{
    protected $table = 'ongkos';
    protected $fillable = [
        'etd',
        'biaya',
        'service'
    ];
}
