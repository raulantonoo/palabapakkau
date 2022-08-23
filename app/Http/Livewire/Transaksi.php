<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Models\Product;
use App\User;
use App\Models\Order;
use App\Model\CartDetail;
use App\Model\AlamatPengiriman;
use Illuminate\Support\Facades\Auth;

class Transaksi extends Component
{
    public $no = 1;
    public $nom = 1;
    public $nomo = 1;
    public $nomor = 1;

    public function transaksi()
    {

        if (Auth::user()) {
            $this->order = Order::where('user_id', Auth::user()->id)
                ->where('status_cart', 'checkout')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            $this->alamat = AlamatPengiriman::where('user_id', Auth::user()->id)
                ->where('status', 'utama')
                ->first();
        } else {
            return abort('403');
        }
    }
    public function mount()
    {

        $this->transaksi();
    }

    public function render()
    {
        return view('livewire.transaksi', [
            'itemorder' => $this->order,
            'itemalamatpengiriman' => $this->alamat,

        ]);
    }
}
