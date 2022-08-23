<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class status_bayar extends Model
{
    protected $table = "status_bayar";
    protected $fillable = ['id', 'keterangan'];
    public function order()
    {
        return $this->hasMany('App\Models\Order', 'id', 'status_bayar_id');
    }
    public function cart()
    {
        return $this->hasMany('App\Model\Cart', 'id', 'status_bayar_id');
    }
}
