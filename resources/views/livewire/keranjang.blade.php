<style>
    .p {
        max-height: 100px;
        min-height: 20px;
        width: auto
    }

    .a {
        margin-left: 2%;
        font-weight: bold;
    }

    body {
        background-color: white;
    }

    .act-btn {

        display: block;
        /* width: 50px; */
        height: 80px;
        line-height: 40px;
        text-align: center;
        color: white;
        font-size: 20px;
        font-weight: bold;
        /* border-radius: 50%; */
        /* -webkit-border-radius: 50%; */
        text-decoration: none;
        transition: ease all 0.3s;
        position: fixed;
        right: 10px;
        /* right: 40px; */
        bottom: 10px;
    }
</style>

<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Produk</li>
            </ol>
        </nav>

        <div class="card " style="background-color:white">
            @if(!empty($itemcart))
            <div class="a mt-2">
                {{ $itemcart->user->name}} Shopping Cart
            </div>

            <!-- alert -->
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
            <!-- emdalert -->

            <div class="card-body">
                <div class="col-md-3 m-2 pl-1">
                    <form action="{{ url('kosongkan').'/'.$itemcart->id }}" method="post">
                        @method('patch')
                        @csrf()
                        <button type="submit" class="btn btn-outline-danger btn-sm ">Kosongkan Keranjang <i class="fa-solid fa-eraser"></i></button>
                    </form>
                </div>

                @else
                <td colspan="7">Keranjang Anda Kosong <i class="far fa-surprise"></i></td>

                @endif

                <div class="row">
                    <div class="col-md-8 mr-0">
                        <table class="table table-stripped table-responsive">
                            <tbody>
                                @if(!empty($itemcart))
                                @forelse($itemdetail as $detail)
                                <tr class="product_data">
                                    <td>
                                        <input name="cekcek" data-id="{{$detail->id}}" name="id[]" value="{{$detail->subtotal}}" class="toggle-class" type="checkbox" {{ $detail->status ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <img src="{{ url('/images/'.$detail->product->gambar) }}" class="img-fluid p">
                                    </td>
                                    <td class=" text-center col-sm-4">
                                        @if($detail->product->stok>0)
                                        <span style="color:blue;font-weight:bold;font-size:9px"> <i class="fas fa-check success"></i> Ready Stok (Tersedia {{ $detail->product->stok}} item)</span>
                                        @else
                                        <span> <i class="fas fa-times danger"></i> Stok Habis</span>
                                        @endif
                                        <br />
                                        {{ $detail->product->nama}}
                                        <br />
                                        {{ $detail->product->ukuran}}
                                        <br />
                                        @if($detail->product->promo >0)
                                        <s class="harga">Rp {{number_format( $detail->product->harga,2,',','.' )}}</s>
                                        <br />
                                        <b style="color:red;"> Disc {{ $detail->product->promo *100}}%</b>

                                        <b class="diskon" style="color:red;font-size:0.7rem">(Rp {{number_format( $detail->diskon,2,',','.')}})</b>
                                        <br />
                                        <b>Rp {{number_format(( $detail->product->harga)-($detail->diskon), 2, ',','.') }}</b>
                                        @else
                                        <b class="harga">Rp {{number_format($detail->product->harga,2,',','.')}}</b>
                                        @endif
                                    </td>
                                    <td class=" text-center col-md-2">
                                        <div class="btn-group" role="group">
                                            @if($detail->product->stok > $detail->qty && $detail->qty > 1)
                                            <form action="{{ route('cart.update',$detail->id) }}" method="post">
                                                @method('patch')
                                                @csrf()
                                                <input type="hidden" name="param" value="kurang">
                                                <button class="btn btn-outline-info btn-sm">
                                                    -
                                                </button>
                                            </form>

                                            <button class="btn btn-outline-primary btn-sm" disabled="true">
                                                {{ number_format($detail->qty) }}
                                            </button>

                                            <form action="{{ route('cart.update',$detail->id) }}" method="post">
                                                @method('patch')
                                                @csrf()
                                                <input type="hidden" name="param" value="tambah">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    +
                                                </button>
                                            </form>
                                            @elseif($detail->qty >= $detail->product->stok && $detail->qty >=1)
                                            <form action="{{ route('cart.update',$detail->id) }}" method="post">
                                                @method('patch')
                                                @csrf()
                                                <input type="hidden" name="param" value="kurang">
                                                <button class="btn btn-outline-info btn-sm">
                                                    -
                                                </button>
                                            </form>
                                            <button class="btn btn-outline-primary btn-sm" disabled="true">
                                                {{ number_format($detail->qty) }}
                                            </button>
                                            <form action="{{ route('cart.update',$detail->id) }}" method="post">
                                                @method('patch')
                                                @csrf()
                                                <input type="hidden" name="param" value="tambah">
                                                <button class="btn btn-outline-primary btn-sm" disabled>
                                                    +
                                                </button>
                                            </form>
                                            @elseif( $detail->qty == '1')
                                            <form action="{{ route('cart.update',$detail->id) }}" method="post">
                                                @method('patch')
                                                @csrf()
                                                <input type="hidden" name="param" value="kurang">
                                                <button class="btn btn-outline-info btn-sm" disabled>
                                                    -
                                                </button>
                                            </form>
                                            <button class="btn btn-outline-primary btn-sm" disabled="true">
                                                {{ number_format($detail->qty) }}
                                            </button>
                                            <form action="{{ route('cart.update',$detail->id) }}" method="post">
                                                @method('patch')
                                                @csrf()
                                                <input type="hidden" name="param" value="tambah">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    +
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>

                                    <td class=" text-center col-md-2">
                                        Rp {{number_format($detail->subtotal,2,',','.')}}
                                    </td>

                                    <td>
                                        <input type="hidden" class="id" value="{{$detail->id}}">
                                        <button class=" btn btn-sm btn-outline-danger delete_cart_data">
                                            <li class="fa fa-trash-o"></li>
                                        </button>
                                    </td>

                                    @empty
                                <tr>
                                    <td colspan="7">Keranjang Anda Kosong <i class="far fa-surprise"></i></td>
                                </tr>
                                @endforelse
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col md-3 text-center">
                        <div class="mb-2 mt-2" style="color:black;font-weight:bold">
                            <h5><b>Total</b></h5>
                        </div>
                        <div id="msg" class="mb-2 mt-2" style="color:black;font-weight:bold">
                            @if(!empty($itemcart))
                            <td> Rp {{number_format($itemcart->subtotal,2,',','.')}}</td>
                            @endif
                        </div>
                        <a class="btn btn-sm btn-outline-success" href="/checkout">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var detail_id = $(this).data('id');
            // location.reload()
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStat',
                data: {
                    'status': status,
                    'detail_id': detail_id
                },
                success: function(data) {
                    console.log(data.success)

                }
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input:checkbox').change(function() {
            var subtotal = 0;

            $('input:checkbox:checked').each(function() { // iterate through each checked element.
                subtotal += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
            });

            console.log(subtotal)
            $("#subtotal").val(subtotal);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/updatetotal',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'subtotal': subtotal
                },
                success: function(data) {
                    alert(data.success)
                }
            });
            var number_string = subtotal.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            document.getElementById("msg").innerHTML = "Rp " + rupiah + ",00";
            // event.preventDefault()

            //console.log(total);
        });

        $('.delete_cart_data').click(function(e) {
            e.preventDefault();

            var id = $(this).closest(".product_data").find('.id').val();
            // alert(id);

            $.ajax({
                method: "POST",
                url: "delete-cart-item",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    });
</script>