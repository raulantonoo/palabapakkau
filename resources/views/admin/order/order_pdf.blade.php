<style>
    .text-center {
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .table thead tr th {
        margin-left: 50px;
        margin-right: 50px;
    }
</style>



<body>
    <div>
        <h4 class="text-center">
            Laporan Penjualan Toko
        </h4>
    </div>
    <div class=" table-responsive col-sm-12 ">
        <table class=" table table-striped table-striped table-border m-1">
            <thead style="background-color:#f5f5dc;margin:10px" style="margin-right:100px">
                <tr class="text-center">
                    <th>NO INVOICE</th>
                    <th>NAMA</th>
                    <th>PEMBAYARAN</th>
                    <th>TOTAL</th>
            <tbody>
                @foreach($order as $o)
                <tr>
                    <td align="center" style="width:200px;height:40px;">{{$o->no_inv}}</td>
                    <td align="center" style="width:100px"> {{ $o->user->name}}</td>
                    <td align="center" style="width:200px;color:green">{{$o->status_bayar->keterangan}}</td>
                    <td align="center" style="width:200px">Rp {{number_format($o->cart->subtotal)}},-</td>

                </tr>
                <tr>

                </tr>
                @endforeach
                <tr>
                    <td>
                        Total
                    </td>
                    <td>

                    </td>
                </tr>

            </tbody>
        </table>

        <br />

    </div>
    </div>
</body>

</html>