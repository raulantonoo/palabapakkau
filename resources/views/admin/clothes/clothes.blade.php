@extends('layouts_admin.app')

@section('content')

<body>
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
                        <div> Jumlah Produk : {{ $clothes->total() }} <br /></div>

                        <div class=" card">


                            <div class=" table-responsive col-sm-12 ">
                                <table class="table table-striped  table-striped table-border m-1 datatable-scroll-y">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Gambar</th>
                                            <th>Jenis</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Deskripsi</th>
                                            <th colspan="2">Opsi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clothes as $c)
                                        <tr>
                                            <td><img width="100px" src="{{ url('/images/'.$c->gambar) }}"></td>
                                            <td>{{@$c->category->keterangan}}</td>
                                            <td>{{$c->nama}}</td>
                                            <td>Rp {{$c->harga}}</td>
                                            <td>{{$c->stok}}</td>
                                            <td>{{$c->deskripsi}}</td>
                                            <td><a href="/clothes_edit/{{ $c->id}}"><button class="btn btn-success fa-solid fa-pen-to-square">Edit</button></a></td>
                                            <td> <button class="btn btn-danger btn-flat btn-sm remove-user" data-id="{{ $c->id }}" data-action="{{ route('delete_clothes',$c->id) }}"> Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <br />
                                <!-- Halaman : {{ $clothes->currentPage() }} <br /> -->

                                <!-- Data Per Halaman : {{ $clothes->perPage() }} <br /> -->
                                {{ $clothes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", ".remove-user", function() {
            var current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
            }, function(result) {
                if (result) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html("<form class='form-inline remove-form' method='post' action='" + action + "'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    </script>

    <!-- add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Data </h5>
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
                            <label class="col-form-label col-lg-2">Deskripsi</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Stok</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="stok">
                            </div>
                        </div>

                        <div class="form-group">
                            <div style="position:relative;">
                                <a class='btn btn-info col-sm-3' href='javascript:;'>
                                    Choose Image...
                                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="gambar" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                                </a>
                                &nbsp;
                                <span class='label label-info' id="upload-file-info"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" value="Upload" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection