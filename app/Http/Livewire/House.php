<?php

namespace App\Http\Livewire;

use App\Model\Category;
use App\Models\Product;
use Livewire\Component;

class House extends Component
{
    public function render()
    {
        return view('livewire.house', [
            'products' => Product::inRandomOrder()->take(8)->get(),
            'categories' => Category::all()
        ]);
    }
}
