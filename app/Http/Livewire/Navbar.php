<?php

namespace App\Http\Livewire;

use App\Model\Category;
use App\Model\Cart;
use App\Model\Wishlist;
use App\Model\CartDetail;
use App\Model\WishlistDetail;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Navbar extends Component
{
    public $jumlah = 0;
    public $jumlah_wish = 0;

    protected $listeners = [
        'masukKeranjang' => 'updateKeranjang',
        'masukWish' => 'updateWish'
    ];



    public function updateKeranjang()
    {
        if (Auth::user()) {
            $pesanan = Cart::where('user_id', Auth::user()->id)->where('status_cart', 'cart')->first();
            if ($pesanan) {
                $this->jumlah = CartDetail::where('cart_id', $pesanan->id)
                    ->count();
            } else {
                $this->jumlah = 0;
            }
        }
    }


    public function updateWish()
    {
        if (Auth::user()) {
            $wish = Wishlist::where('user_id', Auth::user()->id)->first();
            if ($wish) {
                $this->jumlah_wish = WishlistDetail::where('wishlist_id', $wish->id)->count();
            } else {
                $this->jumlah_wish = 0;
            }
        }
    }


    public function mount()
    {
        $this->updateKeranjang();
        $this->updateWish();
    }

    public function render()
    {
        return view('livewire.navbar', [
            'categories' => Category::all(),
            'jumlah_pesanan' => $this->jumlah,
            'jumlah_wish' => $this->jumlah_wish,
        ]);
    }
}
