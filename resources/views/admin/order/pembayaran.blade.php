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
                    <div class="text-right">
                        <a class=" mt-2 mb-2 btn btn-outline-primary" href="/pesanan/cetak_pdf" target="_blank">Cetak PDF</a>
                    </div>
                    <div class=" card ">
                        <div class=" pt-2 pr-1 pl-1 table-responsive col-sm-12 ">
                            <table id="table_id" class="table table-striped  table-striped table-border m-1 datatable-scroll-y">
                                <thead>
                                    <tr class="text-center">
                                        <th>NO INVOICE</th>
                                        <th>NAMA</th>
                                        <th>PEMBAYARAN</th>
                                        <th>PENGIRIMAN</th>
                                        <th>PENGIRIMAN</th>
                                        <th>NO RESI</th>
                                        <th class="text-center mr-2 ml-2">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $o)
                                    <tr>
                                        <td>{{$o->no_inv}}</td>
                                        <td> {{ $o->user->name}}</td>
                                        <td>{{$o->status_bayar->keterangan}}</td>
                                        <td>{{$o->status_kirim->keterangan}}</td>
                                        @if($o->jasa == 'tiki')
                                        <td>Tiki</td>
                                        @elseif($o->jasa == 'pos')
                                        <td>Pos Indonesia</td>
                                        @elseif ($o->jasa == 'jne')
                                        <td>JNE</td>
                                        @endif
                                        <td>{{$o->no_resi}}</td>
                                        <td>

                                            <a class="btn btn-outline-success" style="text-decoration:none;" href="/order_detail/{{$o->id}}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <button class="btn btn-outline-info editbtn" value="{{$o->id}}"><i class="fa-solid fa-pen"></i></button>
                                            <button class="btn btn-outline-danger deletebtn" value="{{$o->id}}"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
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
                    $('#status_kirim_id').val(response.order.status_kirim_id);
                    $('#status_bayar_id').val(response.order.status_bayar_id);
                    $('#no_resi').val(response.order.no_resi);
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
            <div class="modal-header text-center pb-3" style="background-color:#e9ecef">
                <h5 class="modal-title">Update Status Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM UPDATE BARANG-->
                <form action="/pesanan/update" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label> Status Pembayaran</label>
                        <div class="pl-0 col-lg-5">
                            <select id="status_bayar_id" name="status_bayar_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value=>-- pilih status pembayaran --</option>
                                @foreach($status_bayar as $b)
                                <option value="{{$b->id}}">{{$b->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Status Pengiriman</label>
                        <div class="pl-0 col-lg-5">
                            <select id="status_kirim_id" name="status_kirim_id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value=>-- pilih status pengiriman--</option>
                                @foreach($status_kirim as $k)
                                <option value="{{$k->id}}">{{$k->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Nomor Resi</label>
                        <div class="pl-0 col-lg-10">
                            <input type="text" class="form-control" id="no_resi" name="no_resi">
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id"> <br />


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </form>
                <!--END FORM UPDATE BARANG-->
            </div>
        </div>
    </div>
</div>
<!-- End Modal UPDATE Barang-->
@endsection