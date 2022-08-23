<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'cart_id',
        'nama_penerima',
        'no_tlp',
        'no_resi',
        'total_item',
        'alamat',
        'total',
        'subtotal',
        'ongkir',
        'jasa',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kodepos',
        'status_bayar',
        'no_inv',
        'user_id',
        'status_cart'
    ];

    public function cart()
    {
        return $this->belongsTo('App\Model\Cart', 'cart_id');
    }
    public function cartdetail()
    {
        return $this->hasMany('App\Model\CartDetail', 'order_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function status_bayar()
    {
        return $this->belongsTo('App\Model\status_bayar', 'status_bayar_id', 'id');
    }

    public function status_kirim()
    {
        return $this->belongsTo('App\Model\status_kirim', 'status_kirim_id', 'id');
    }
}
