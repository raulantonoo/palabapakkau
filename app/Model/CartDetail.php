<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = "cart_details";
    protected $fillable = ['id', 'status_cart', 'order_id', 'subtotal', 'harga', 'qty', 'cart_id', 'product_id', 'diskon'];
    public function cart()
    {
        return $this->belongsTo('App\Model\Cart', 'cart_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty, $harga, $diskon)
    {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        $this->attributes['subtotal'] = $itemdetail->subtotal + (($qty * $harga) - ($qty * $diskon));
        self::save();
    }
}
