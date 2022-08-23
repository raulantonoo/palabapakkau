<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Model\Cart;
use App\Model\CartDetail;
use Illuminate\Support\Facades\Auth;

class TransaksiDetail extends Component
{
    public function mount($id)
    {
        $this->order = Order::find($id);
    }

    public function render()
    {
        return view('livewire.transaksi-detail', [
            'order' => $this->order,

        ]);
    }
}
