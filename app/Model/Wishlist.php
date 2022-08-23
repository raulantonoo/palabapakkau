<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $table = 'wishlists';
    protected $fillable = [
        'user_id',
        'status',
        'id'
    ];

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
        return $this->hasMany('App\Model\WishlistDetail', 'wishlist_id');
    }
}
