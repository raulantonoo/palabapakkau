<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class status_kirim extends Model
{
    protected $table = "status_kirim";
    protected $fillable = ['id', 'keterangan'];
    public function order()
    {
        return $this->hasMany('App\Models\Order', 'id', 'status_kirim_id');
    }
    public function cart()
    {
        return $this->hasMany('App\Model\Cart', 'id', 'status_kirim_id');
    }
}
