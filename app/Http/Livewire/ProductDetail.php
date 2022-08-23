<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Model\Cart;
use App\Model\Wishlist;
use App\Model\CartDetail;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $product, $nama, $jumlah_pesanan, $nomor;

    public function mount($id)
    {
        $this->product = Product::find($id);
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product,

        ]);
    }
}
