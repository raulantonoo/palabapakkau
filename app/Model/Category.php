<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = "categories";
    protected $fillable = ['id', 'keterangan'];

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'category_id', 'id');
    // }
}
