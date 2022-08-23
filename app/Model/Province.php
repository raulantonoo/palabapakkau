<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "provinces";
    protected $fillable = ['name'];
}
