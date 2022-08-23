<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Model\Cart;
use App\Model\CartDetail;
use App\Model\Wishlist;
use App\Model\WishlistDetail;

class Wish extends Component
{
    protected $wish;
    protected $wish_details = [];
    public function index()
    {
        if (Auth::user()) {
            $this->wish = Wishlist::where('user_id', Auth::user()->id)->where('status', 'wishlist')->first();
            if ($this->wish) {
                $this->wish_details = WishlistDetail::where('wishlist_id', $this->wish->id)->get();
            }
        }
    }

    public function mount()
    {
        $this->index();
    }
    public function render()
    {
        return view('livewire.wish', [
            'itemwish' => $this->wish,
            'detail' => $this->wish_details
        ]);
    }
}
