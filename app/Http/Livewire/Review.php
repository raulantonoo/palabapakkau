<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Model\Ulasan;

class Review extends Component
{
    public function render()
    {
        $this->ulasan = Ulasan::get();
        return view('livewire.review', [
            'ulasan' => $this->ulasan,
        ]);
    }
}
