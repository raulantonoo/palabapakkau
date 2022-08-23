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
    <div class="card " style="padding-bottom:10%">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Produk</li>
            </ol>
        </nav>

        <div class="row m-0">
            <div class="col">

                <div class="a mt-3 ">
                    Riwayat Transaksi
                </div>
                <div class="card-body">
                    <!-- digunakan untuk menampilkan pesan error atau sukses -->
                    @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                    <div class="alert alert-warning">{{ $error }}</div>
                    @endforeach
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-warning">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif


                    <!-- mmmmm -->
                    <div class="tab">
                        <button style="background-color:#040429;color:white" class=" col-md-3 tablinks pl-5 pr-5" onclick="openCity(event, 'pembayaran')">Belum bayar</button>
                        <button style="background-color:#050f55 ;color:white" class=" col-md-3  tablinks pl-5 pr-5" onclick="openCity(event, 'dikemas')">Dikemas</button>
                        <button style="background-color:#041870;color:white" class="col-md-3 tablinks pl-5 pr-5" onclick="openCity(event, 'dikirim')">Dikirim</button>
                        <button style="background-color:#062d89;color:white" class="col-md-3 tablinks pl-5 pr-5" onclick="openCity(event, 'selesai')">Selesai</button>
                    </div>

                    <div id="pembayaran" class="tabcontent p-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th>Status Pembayaran</th>
                                        <th colspan="3">Opsi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($itemorder))
                                    @foreach($itemorder as $order)
                                    @if($order->status_bayar_id!==2)
                                    <tr class="text-center">
                                        <td>
                                            {{$no++}}
                                        </td>
                                        <td>
                                            {{ $order->no_inv }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($order->total, 2, ',','.') }}
                                        </td>
                                        <td>
                                            @if($order->status_bayar_id == 0)
                                            <span class="p-1" style="color:red; font-weight:bold">Belum dibayar</span>
                                            @else($order->status_bayar_id == 1)
                                            <span class="p-1" style="color:#fcd12a;font-weight:bold">Menunggu pembayaran</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status_bayar_id==0)
                                            <a class="btn btn-sm btn-outline-primary" style="text-decoration:none;" href="{{url('pay/'.$order->id)}}">Pilih metode pembayaran</a>
                                            @else($order->status_bayar_id ==1)
                                            <a class="btn btn-sm btn-outline-primary" style="text-decoration:none;" href="{{url('pay/'.$order->id)}}">Cek kode pembayaran</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('transaksi.destroy', $order->id) }}" method="post" style="display:inline;">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </td>

                                        <td>

                                            <a class="btn btn-sm btn-outline-success" style="text-decoration:none;" href="{{ route('transaksi.detail', $order->id) }}">
                                                Detail
                                            </a>

                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @else
                                    <tr>
                                        Kosong
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="dikemas" class="tabcontent p-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th>Status Pembayaran</th>
                                        <th colspan="2">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemorder as $order)
                                    @if($order->status_bayar_id==2 && $order->status_kirim_id==1 )
                                    <tr class="text-center">
                                        <td>
                                            {{$nom++}}
                                        </td>
                                        <td>
                                            {{ $order->no_inv }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($order->total, 2, ',','.') }}
                                        </td>
                                        <td>
                                            <span class="p-2" style="color:GREEN; font-weight:bold">Pesanan sedang disiapkan penjual</span>
                                        </td>
                                        <td>


                                            <a class="btn btn-sm btn-outline-success" style="text-decoration:none;" href="{{ route('transaksi.detail', $order->id) }}">
                                                Detail
                                            </a>


                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="dikirim" class="tabcontent p-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th>Nomor Resi</th>
                                        <th colspan="2">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemorder as $order)
                                    @if($order->status_kirim_id==2 && $order->status_bayar_id==2)
                                    <tr class="text-center">
                                        <td>
                                            {{$nomo++}}
                                        </td>
                                        <td>
                                            {{ $order->no_inv }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($order->total, 2, ',','.') }}
                                        </td>
                                        <td>
                                            No.resi : {{ $order->no_resi }}
                                        </td>

                                        <td>

                                            <a class="btn btn-sm btn-outline-success" style="text-decoration:none;" href="{{ route('transaksi.detail', $order->id) }}">
                                                Detail
                                            </a>

                                        </td>
                                        <td>
                                            <a href="/transaksi/edit/{{ $order->id }}"><button class="btn btn-sm btn-success">
                                                    Konfirmasi Pesanan
                                                </button></a>
                                        </td>


                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="selesai" class="tabcontent p-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th colspan="2">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemorder as $order)
                                    @if($order->status_kirim_id==3 &&$order->status_bayar_id==2)
                                    <tr class="text-center">
                                        <td>
                                            {{$nomor++}}
                                        </td>
                                        <td>
                                            {{ $order->no_inv }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($order->total, 2, ',','.') }}
                                        </td>
                                        <td>

                                            <a class="btn btn-sm btn-outline-success" style="text-decoration:none;" href="{{ route('transaksi.detail', $order->id) }}">
                                                Detail
                                            </a>

                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- mmmmm -->

                </div>
            </div>
        </div>
    </div>
</div>
@include('livewire.footer')

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>