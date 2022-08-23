<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';
    protected $fillable = [
        'nama',
        'komentar',

    ];
}
