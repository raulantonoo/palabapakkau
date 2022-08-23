<style>
    .a {
        margin-left: 2%;
        font-weight: bold;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        /* padding: 6px 12px; */
        border: 1px solid #ccc;
        border-top: none;
    }

    .tab {
        overflow: hidden;
        background-color: #e9ecef;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 14px;
        text-align: center;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    body {
        background-color: white;
    }
</style>
<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/transaksi">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Pembayaran</li>
            </ol>
        </nav>
        <div class="row m-0">
            <div class="col">
                <div class="col-md-6">
                    @if($order->status_bayar_id == 0)
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button id="pay-button" type="button" class="btn btn-outline-primary mt-3 center-block">
                                Pilih metode pembayaran
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="col-md-12">
                            <div class=" mt-2">
                                <b> Riwayat Pembayaran</b>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table" style="border-top:hidden">
                                        <tr>
                                            <td>Total harga</td>
                                            <td>:</td>
                                            <td>{{$gross_amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>{{$transaction_status }}</td>
                                        </tr>
                                        <tr>
                                            <td>batas waktu bayar</td>
                                            <td>:</td>
                                            <td>{{$deadline}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card">
                        <div class="col-md-12">
                            <div class="a mt-2">
                                Riwayat Pembayaran
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table class="table" style="border-top:hidden">
                                        <tr>
                                            <td>Total harga</td>
                                            <td>:</td>
                                            <td>Rp {{number_format($gross_amount), 2, ',','.'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            @if($transaction_status=='pending')
                                            <td style="color:red">Menunggu pembayaran</td>
                                            @else($transaction_status=='settlement')
                                            <td style="color:green">Pembayaran berhasil</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Batas waktu pembayaran</td>
                                            <td>:</td>
                                            <td style="font-weight:bold">{{$deadline}}</td>
                                        </tr>

                                        @if($payment_type=='bank_transfer')
                                        <tr>
                                            <td>Transfer</td>
                                            <td>:</td>
                                            <td>{{$bank}}</td>
                                        </tr>
                                        <tr>
                                            <td>Virtual Number</td>
                                            <td>:</td>
                                            <td>{{$va_number}}</td>
                                        </tr>
                                        @elseif($payment_type=='echannel')
                                        <tr>
                                            <td>Transfer</td>
                                            <td>:</td>
                                            <td>Mandiri</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Bank</td>
                                            <td>:</td>
                                            <td>{{$biller_code}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Pembayaran</td>
                                            <td>:</td>
                                            <td>{{$bill_key}}</td>
                                        </tr>

                                        @elseif($payment_type=='cstore')
                                        <tr>
                                            <td>Transfer</td>
                                            <td>:</td>
                                            <td>Indomart/Alfa</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Transaksi</td>
                                            <td>:</td>
                                            <td>{{$payment_code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Alfa</td>
                                            <td>:</td>
                                            <td>{{$merchant_id }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <form id="payment-form" method="get" action="Payment">
            <input type="hidden" name="result_data" id="result-data" value="">
        </form>
    </div>
</div>




<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Cnmh0bzvnBU6QNms"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type, data) {
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
        }
        snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result) {
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();

            },
            onPending: function(result) {
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
            },
            onError: function(result) {
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
            }
        });
    };
</script>