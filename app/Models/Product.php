<?php

namespace App\Models;

use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['category_id', 'harga_beli', 'terjual', 'ukuran', 'nama', 'stok', 'harga', 'deskripsi', 'gambar'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function detail()
    {
        return $this->hasMany('App\Model\CartDetail', 'product_id');
    }
}
