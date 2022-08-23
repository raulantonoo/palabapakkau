<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductTshirt extends Component
{
    public function render()
    {
        return view('livewire.product-tshirt', [
            'products' => Product::where('category_id', '=', '1')->paginate(12),
        ]);
    }
}
