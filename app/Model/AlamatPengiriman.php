<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    protected $table = 'alamat_pengiriman';
    protected $fillable = [
        'user_id',
        'status',
        'nama_penerima',
        'no_tlp',
        'alamat',
        'province_id',
        'city_id',
        'kecamatan',
        'kelurahan',
        'kodepos',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
}
