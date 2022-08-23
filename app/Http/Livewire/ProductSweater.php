<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSweater extends Component
{
    public function render()
    {
        return view('livewire.product-sweater', [
            'products' => Product::where('category_id', '=', '2')->paginate(12),
        ]);
    }
}
