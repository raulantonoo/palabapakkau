@extends('layouts_admin.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="page-header-content header-elements-md-inline" style="background-color:#e9ecef">
                    <div class="page-title d-flex" style="padding-top:1% !important;padding-bottom:1% !important">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Data Ketersediaan Produk</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="/dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Data Ketersediaan Produk</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class=" card mt-2 ">
                        <div class=" table table-hover pt-2 pr-1 pl-1">
                            <table id="table_id">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Terjual</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="col-2 text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $c)
                                    <tr>
                                        <td class="pr-1 pl-1 text-center">{{$c->nama}}</td>
                                        <td class="pr-1 pl-1 text-center">{{@$c->category->keterangan}}</td>
                                        <td class="pr-0 pl-0 text-center">{{$c->stok}}</td>
                                        <td class="pr-0 pl-0 text-center">{{$c->terjual}}</td>
                                        @if($c->stok > $c->terjual)
                                        <td class="pr-0 pl-0 text-center">Ready {{$c->stok - $c->terjual}}</td>
                                        @else
                                        <td class="pr-0 pl-0 text-center text-danger">Habis</td>
                                        @endif
                                        <td class="mt-auto mb-auto text-center">
                                            <!-- <button class="btn btn-sm btn-outline-primary promobtn" value="{{$c->id}}"><i class="fa-solid fa-tags"></i></button> -->
                                            <button class="btn btn-sm btn-outline-info editbtn" value="{{$c->id}}"><i class="fa-solid fa-pen"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                    url: "/edit_stok/" + id,
                    success: function(response) {
                        console.log(response.product.keterangan)
                        $('#nama').val(response.product.nama);
                        $('#stok').val(response.product.stok);
                        $('#terjual').val(response.product.terjual);
                        $('#id').val(response.product.id);
                    }
                });
            });
        });

    });
</script>


<!-- Modal Update Barang-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center pb-3" style="background-color:#e9ecef">
                <h5 class="modal-title">Update Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/stok/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" name="id"> <br />

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" required="required" class="form-control" name="nama" id="nama" disabled>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Stok</label>
                        <div class="col-lg-5">
                            <select id="stok" name="stok" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Jumlah terjual</label>
                        <div class="col-lg-5">
                            <select id="terjual" name="terjual" class="form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal" required>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
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
            <div class="modal-header">
                <h5 class="modal-title">Delete Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM UPDATE BARANG-->
                <form action="/produk/delete" method="post">
                    @csrf
                    @method('DELETE')
                    <h1>Komfirmasi Hapus Data ?</h1>
                    <input type="hidden" id="deleting_id" name="delete_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
                <!--END FORM UPDATE BARANG-->
            </div>
        </div>
    </div>
</div>
<!-- end delete -->

@endsection