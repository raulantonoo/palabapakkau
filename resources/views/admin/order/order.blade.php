@extends('layouts_admin.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="page-header-content header-elements-md-inline" style="background-color:#e9ecef">
                    <div class="page-title d-flex" style="padding-top:1% !important;padding-bottom:1% !important">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Data Produk</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="/dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Data Produk</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" class="mb-3 btn btn-primary fa-solid fa-square-plus" data-toggle="modal" data-target="#exampleModal">
                        Add Data
                    </button>
                    <a class="btn btn-primary" href="/pesanan/cetak_pdf" target="_blank">CETAK PDF</a>

                    <div class=" card">
                        <!-- <p>baju terjual= {{$jumlah_data}}</p>
                        <br> baju ter checkout {{$cart}}
                        <br> {{$sum}}
                        <br> jumlah tshirt {{$tshirt}} -->

                        <div class=" table-responsive col-sm-12 ">
                            <table class="table table-striped  table-striped table-border m-1 datatable-scroll-y">
                                <thead>
                                    <tr class="text-center">
                                        <th>NO INVOICE</th>
                                        <th>NAMA</th>
                                        <th>STATUS KERANJANG</th>
                                        <th>PEMBAYARAN</th>
                                        <th>PENGIRIMAN</th>
                                        <th>NO RESI</th>
                                        <th colspan="2">Opsi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $o)
                                    <tr>
                                        <td>{{$o->no_inv}}</td>
                                        <td> {{ $o->user->name}}</td>
                                        <td>{{$o->status_cart}}</td>
                                        <td>{{$o->status_bayar->keterangan}}</td>
                                        <td>{{$o->status_kirim->keterangan}}</td>
                                        <td>{{$o->no_resi}}</td>
                                        <td> <button class="btn btn-info editbtn" value="{{$o->id}}">Edit</button></td>
                                        <td> <button class="btn btn-danger deletebtn" value="{{$o->id}}">Delete</button></td>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <br />

                            {{ $order->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(document).on('click', '.deletebtn', function() {
            var id = $(this).val();
            // alert(id);
            $('#deleteModal').modal('show');
            $('#deleting_id').val(id);
        });
        $(document).on('click', '.editbtn', function() {
            var id = $(this).val();
            // alert(id)
            $('#editModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/pesanan_edit/" + id,
                success: function(response) {
                    console.log(response.order.keterangan)
                    $('#nama').val(response.order.nama);
                    $('#id').val(response.order.id);
                }
            });
        });
    });
</script>

<!-- Modal Update Barang-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM UPDATE BARANG-->
                <form action="/pesanan/update" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Status Pembayaran</label>
                        <div class="col-lg-5">
                            <select name="status_bayar_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value=>-- pilih status pembayaran --</option>
                                @foreach($status_bayar as $b)
                                <option value="{{$b->id}}">{{$b->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Status Pengiriman</label>
                        <div class="col-lg-5">
                            <select name="status_kirim_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value=>-- pilih status pengiriman--</option>
                                @foreach($status_kirim as $k)
                                <option value="{{$k->id}}">{{$k->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Nomor Resi</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="no_resi">
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id"> <br />


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
                    </div>
                </form>
                <!--END FORM UPDATE BARANG-->
            </div>
        </div>
    </div>
</div>
<!-- End Modal UPDATE Barang-->
@endsection