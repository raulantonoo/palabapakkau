@extends('layouts_admin.app')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="page-header-content header-elements-md-inline" style="background-color:#e9ecef">
                    <div class="page-title d-flex" style="padding-top:1% !important;padding-bottom:1% !important">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Data User</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none py-0 mb-3 mb-md-0">
                        <div class="breadcrumb">
                            <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            <span class="breadcrumb-item active">Data User</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- <div class="text-right">
                        <a href="/kategoriadd"><button class="btn btn-md btn-outline-success mr-auto mt-2 mb-1">ADD USER
                                <i class="fa-solid fa-plus"></i></button></a>
                    </div> -->
                    <div class=" card pt-2 pr-1 pl-1">

                        <table id="table_id" class="table table-striped table-hover">
                            <thead>
                                <tr class="">
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $k )
                                <tr>
                                    <td>{{$k->name}}</td>
                                    <td>{{$k->email}}</td>
                                    <td class="text-center"><a href=" /user/delete/{{ $k->id }}"><button class="btn btn-sm btn-outline-danger"><span class="fa fa-trash"></span></button></a></td>
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

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endsection