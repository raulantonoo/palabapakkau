<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WishlistDetail extends Model
{
    protected $table = "wishlist_details";
    protected $fillable = ['id', 'product_id',  'wishlist_id'];
    public function wishlist()
    {
        return $this->belongsTo('App\Model\Wishlist', 'wishlist_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
