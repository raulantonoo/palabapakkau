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
                        <button style="margin-right:auto !important" type="button" class=" mt-3 mb-1 btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                            Tambah Data <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    <div class=" card">

                        <div class="table table-stripped table-hover  pt-2 pr-1 pl-1">
                            <table id="table_id">
                                <thead>
                                    <tr class="text-center">
                                        <th>Gambar</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Harga Beli</th>
                                        <th>Deskripsi</th>
                                        <th class="col-3 text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $c)
                                    <tr>
                                        <td class="pr-2 pl-1 text-center"><img width="80px" src="{{ url('/images/'.$c->gambar) }}"></td>
                                        <td class="pr-1 pl-1 text-center">{{@$c->category->keterangan}}</td>
                                        <td class="pr-2 pl-2 ">{{$c->nama}} ({{$c->ukuran}})</td>
                                        <td class="pr-1 pl-1 text-center">Rp {{number_format($c->harga)}},- (Disc {{ $c->promo *100}}%)</td>
                                        <td class="pr-1 pl-1 text-center"> Rp {{number_format($c->harga_beli)}},-</td>
                                        <td class="pr-1 pl-1">{{$c->deskripsi}}</td>
                                        <td class="mt-auto mb-auto text-center">
                                            <!-- <button class="btn btn-sm btn-outline-primary promobtn" value="{{$c->id}}"><i class="fa-solid fa-tags"></i></button> -->
                                            <button class="btn btn-sm btn-outline-info editbtn" value="{{$c->id}}"><i class="fa-solid fa-pen"></i></button>
                                            @if ($c->keranjang==0)
                                            <button class="btn btn-sm btn-outline-danger deletebtn" value="{{$c->id}}"><i class="fa-solid fa-trash"></i></button>
                                            @else
                                            <button class="btn btn-sm btn-outline-danger deletebtn" value="{{$c->id}}" disabled><i class="fa-solid fa-trash"></i></button>
                                            @endif
                                            @if($c->stok == $c->terjual)
                                            <button class="btn btn-sm btn-outline-danger" disabled> <i class="fa-solid fa-xmark"></i></button>
                                            @else
                                            <button class="btn btn-sm btn-outline-success" disabled> <i class="fa-solid fa-check"></i></button>
                                            @endif
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        // datatable
        $('#table_id').DataTable();
        // delete
        $(document).on('click', '.deletebtn', function() {
            var id = $(this).val();
            $('#deleteModal').modal('show');
            $('#deleting_id').val(id);
        });

        $(document).ready(function() {
            $(document).on('click', '.editbtn', function() {
                var id = $(this).val();
                $('#editModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/produk_edit/" + id,
                    success: function(response) {
                        console.log(response.product.keterangan)
                        $('#nama').val(response.product.nama);
                        $('#deskripsi').val(response.product.deskripsi);
                        $('#ukuran').val(response.product.ukuran);
                        $('#harga_beli').val(response.product.harga_beli);
                        $('#harga').val(response.product.harga);
                        $('#promo').val(response.product.promo);
                        $('#category_id').val(response.product.category_id);
                        $('#id').val(response.product.id);
                    }
                });
            });
        });
        // updatepromo
        $(document).on('click', '.promobtn', function() {
            var id = $(this).val();
            $('#promoModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/produk_promo/" + id,
                success: function(response) {
                    //alert(response.product.promo)
                    // alert(id)
                    $('#promo').val(response.product.promo);
                    $('#id').val(response.product.id);
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
                <h5 class="modal-title">Update Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/produk/update" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Kategori</label>
                        <select id="category_id" name="category_id" class=" col-md-4 form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                            <option value=>-- Pilih Kategori --</option>
                            @foreach($category as $k)
                            <option value="{{$k->id}}">{{$k->keterangan}}</option>
                            @endforeach
                        </select>

                    </div>
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" required="required" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" required="required" class="form-control" name="deskripsi" id="deskripsi">
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" required="required" class="form-control" name="ukuran" id="ukuran">
                    </div>

                    <div class="form-group">
                        <label>Harga Beli</label>
                        <input type="text" required="required" class="form-control" name="harga_beli" id="harga_beli">
                    </div>
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input type="text" required="required" class="form-control" name="harga" id="harga">
                    </div>
                    <div class="form-group">
                        <label>Promo</label>
                        <input type="text" required="required" class="form-control" name="promo" id="promo">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal UPDATE Barang-->

<!-- delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center pb-3" style="background-color:#e9ecef">
                <h5 class="modal-title">Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM UPDATE BARANG-->
                <form action="/produk/delete" method="post">
                    @csrf
                    @method('DELETE')
                    <h3>Anda yakin menghapus data?</h3>
                    <input type="hidden" id="deleting_id" name="delete_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-outline-primary">Hapus</button>
                    </div>
                </form>
                <!--END FORM UPDATE BARANG-->
            </div>
        </div>
    </div>
</div>
<!-- end delete -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center pb-3" style="background-color:#e9ecef">
                <h5 class=" modal-title" id="exampleModalLabel">Tambahkan Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/store" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Kategori</label>
                        <div class="col-lg-10">
                            <select name="category_id" id="id" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value=>-- Pilih Kategori --</option>
                                @foreach($category as $k)
                                <option value="{{$k->id}}">{{$k->keterangan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Nama</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Ukuran</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="ukuran">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Harga</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="harga">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Harga Beli</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="harga_beli">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Deskripsi</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="deskripsi">
                        </div>
                    </div>

                    <div class="form-group">
                        <div style="position:relative;">
                            <a class='btn btn-outline-info col-sm-3' href='javascript:;'>
                                Pilih gambar
                                <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="gambar" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                            </a>
                            &nbsp;
                            <span class='label label-info' id="upload-file-info"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" value="Upload" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection