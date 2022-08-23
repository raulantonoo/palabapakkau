<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{

    protected $table = "clothes";
    protected $fillable = ['category_id', 'ukuran', 'nama', 'stok', 'harga', 'deskripsi', 'gambar'];

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }
}
