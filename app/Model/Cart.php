<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    protected $fillable = ['id', 'total', 'subtotal', 'status_cart', 'user_id'];
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function detail()
    {
        return $this->hasMany('App\Model\CartDetail', 'cart_id');
    }

    public function updatetotal($itemcart, $subtotal)
    {
        $this->attributes['subtotal'] = $itemcart->subtotal + $subtotal;
        $this->attributes['total'] = $itemcart->total + $subtotal;
        self::save();
    }
}
