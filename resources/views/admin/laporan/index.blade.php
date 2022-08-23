@extends('layouts_admin.app')

@section('content')


<head>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="page-header-content header-elements-md-inline" style="background-color:#e9ecef">
                    <div class="page-title d-flex" style="padding-top:1% !important;padding-bottom:1% !important">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Data Penjualan</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="/dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Data Penjualan</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="m-2">Cari data transaksi</h3>
                            <div class="my-2">
                                <form action="/laporan_keuangan" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" name="start_date">
                                        <input type="date" class="form-control" name="end_date">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $data->no_inv }}</td>
                                        <td>{{ $data->nama_penerima}}</td>
                                        <td>Rp {{ number_format($data->total,2,',','.')}}</td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <div class="mt-4">
                                <div class="col mb-2">
                                    <div class="col-md-12  pt-2 pb-2" style="background-color:#04082e;color:white">
                                        Data Pemasukan
                                    </div>
                                    <div class="col-md-12  pt-2 pb-2" style="background-color:#447695;color:white">
                                        Modal
                                        <br>Rp {{number_format($modal,2,',','.') }}
                                    </div>
                                    <div class="col-md-12  pt-2 pb-2" style="background-color:#8EAAB3">
                                        Pendapatan seharusnya
                                        <br>Rp {{number_format($max_jual,2,',','.') }}
                                    </div>
                                    <div class="col-md-12 pt-2 pb-2" style="background-color:#BFD1DB">
                                        Pendapatan sekarang
                                        <br>Rp {{number_format($jual,2,',','.') }}
                                    </div>
                                    <div class="col-md-12  pt-2 pb-2" style="background-color:#DEE6E9">
                                        Keuntungan
                                        @if($jual > $modal)
                                        <br>Rp {{number_format($untung,2,',','.') }}
                                        @else
                                        <br> -
                                        @endif
                                    </div>
                                </div>
                                <!-- <table>
                                    <tr class="mr-3">
                                        <td>

                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Hasil Jual seharusnya
                                        </td>
                                        <td>
                                            {{number_format($max_jual)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Penjualan
                                        </td>
                                        <td>
                                            {{number_format($jual)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$jml}}
                                        </td>
                                    </tr>
                                </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

@endsection