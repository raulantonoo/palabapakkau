<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class Pay extends Component
{
    public $snapToken;
    public $order;
    public $biller_code, $bill_key, $va_number, $gross_amount, $bank, $transaction_status,
        $deadline, $payment_type, $settlement_time, $merchant_code, $payment_code, $merchant_id;


    public function mount($id)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-BtX_AKUqGKynk1RxZZB1mcW5';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (isset($_GET['result_data'])) {
            $current_status = json_decode($_GET['result_data'], true);
            $order_id = $current_status['order_id'];
            $this->order = Order::where('id', $order_id)->first();
            $this->order->status_bayar_id = 1;
            $this->order->update();
        } else {
            $this->order = Order::find($id);
        }

        if (!empty($this->order)) {
            if ($this->order->status_bayar_id == 0) {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $this->order->id,
                        'gross_amount' => $this->order->cart->total,
                    ),
                    'customer_details' => array(
                        'first_name' => 'Mr/Mrs',
                        'last_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => $this->order->no_tlp,
                    ),
                );
                $this->snapToken = \Midtrans\Snap::getSnapToken($params);
            } else if ($this->order->status_bayar_id == 1) {
                $status = \Midtrans\Transaction::status($this->order->id);
                $status = json_decode(json_encode($status), true);
                //dd($status);
                // $this->va_number              = $status['va_numbers'][0]['va_number'];
                $this->gross_amount           = $status['gross_amount'];
                // $this->bank                   = $status['va_numbers'][0]['bank'];
                $this->transaction_status     = $status['transaction_status'];
                $this->payment_type             = $status['payment_type'];
                $transaction_time             = $status['transaction_time'];
                $this->deadline               = date('d-m-Y H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                if ($this->payment_type == 'bank_transfer') {
                    $this->va_number              = $status['va_numbers'][0]['va_number'];
                    $this->bank                   = $status['va_numbers'][0]['bank'];
                } else if ($this->payment_type == 'echannel') {
                    $this->biller_code             = $status['biller_code'];
                    $this->bill_key              = $status['bill_key'];
                } else if ($this->payment_type == 'cstore') {
                    $this->payment_code          = $status['payment_code'];
                    $this->merchant_id          = $status['merchant_id'];
                }
                if ($this->transaction_status  == 'settlement') {
                    $this->order->status_bayar_id = 2;
                    $this->order->status_kirim_id = 1;
                    $this->order->update();
                }
            }
        }
    }

    public function render()
    {

        return view('livewire.pay');
    }
}
