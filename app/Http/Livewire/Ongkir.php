<?php

namespace App\Http\Livewire;

use Kavist\RajaOngkir\RajaOngkir;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Models\Product;
use App\User;
use App\Model\CartDetail;
use App\Model\AlamatPengiriman;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ongkir extends Component
{

    public $cart;
    private $apikey = 'eff28633d0e44808001d2f106004276b';
    public $provinsi_id, $kota_id, $jasa, $daftarProvinsi, $daftarKota, $nama_jasa;
    public $result = [];
    public function mount($id)
    {
        if (!Auth::user()) {
            return redirect()->route('house');
        }
        $this->cart = Cart::find($id);
    }

    public function getOngkir()
    {
        $this->alamat = AlamatPengiriman::where('user_id', Auth::user()->id)
            ->where('status', 'utama')
            ->first();
        if (!$this->alamat->province_id || !$this->alamat->city_id || !$this->jasa) {
            return;
        }
        //mengambil data cart


        $rajaongkir = new RajaOngkir($this->apikey);
        $cost = $rajaongkir->ongkosKirim([
            'origin' => 489,
            'destination' => $this->alamat->city_id,
            'weight' => 100,
            'courier' => $this->jasa,
        ])->get();

        //dd($cost);
        $this->nama_jasa = $cost[0]['name'];
        foreach ($cost[0]['costs'] as $row) {
            $this->result[] = array(
                'description' => $row['description'],
                'service' => $row['service'],
                'biaya' => $row['cost'][0]['value'],
                'etd' => $row['cost'][0]['etd']
            );
        }

        // dd($this->result);
        $this->cart->kota = $this->alamat->city_id;
        $this->cart->provinsi = $this->alamat->province_id;
        $this->cart->jasa = $this->jasa;

        $this->cart->update();
        return back();
    }
    public function save_ongkir($biaya_pengiriman)
    {
        $this->cart->ongkir = $biaya_pengiriman;
        $this->cart->total =  $this->cart->subtotal + $biaya_pengiriman;
        $this->cart->status_ongkir = 1;
        $this->cart->update();

        return redirect()->to('checkout');
    }

    public function render()
    {
        $this->alamat = AlamatPengiriman::where('user_id', Auth::user()->id)
            ->where('status', 'utama')
            ->first();
        return view('livewire.ongkir', [
            'alamat' => $this->alamat
        ]);
    }
}
