<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductAll extends Component
{

    public function render()
    {
        $this->product = Product::inRandomOrder()->paginate(12);
        return view('livewire.product-all', [
            'products' => $this->product,
        ]);
    }
}
