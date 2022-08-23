<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Model\Cart;
use App\Model\CartDetail;
use Illuminate\Support\Facades\Auth;


class Keranjang extends Component
{
    protected $pesanan;
    protected $pesanan_details = [];

    public function index()
    {

        if (Auth::user()) {
            $this->pesanan = Cart::where('user_id', Auth::user()->id)->where('status_cart', 'cart')->first();
            if ($this->pesanan) {
                $this->pesanan_details = CartDetail::where('cart_id', $this->pesanan->id)
                    ->get();
            }
            // dd($this->pesanan_details);
        } else {
            return abort('403');
        }
    }
    // 

    public function mount()
    {
        $this->index();
    }
    public function render()
    {
        return view('livewire.keranjang', [
            'itemcart' => $this->pesanan,
            'itemdetail' => $this->pesanan_details
        ]);
    }
}
