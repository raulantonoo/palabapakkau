@extends('layouts_user.app')

@section('content')

<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Profil</li>
            </ol>
        </nav>

        <!-- membuat komponen main yang berisi form untuk mengisi judul dan isi artikel -->
        <div class="col-sm-12 bg-white p-4">
            <h1>PERBAHARUI DATA DIRI</h1>
            <form method="post" action="/proses">
                @csrf
                <input type="hidden" value="{{ $user->id }}" name="id">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>NAMA</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                    </div>
                    <div class="form-group col-md-5">
                        <label>EMAIL</label>
                        <input type="text" class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>NO HP</label>
                        <input type="text" class="form-control" value="{{ $user->no_hp }}" name="no_hp">
                    </div>
                    <div class="form-group col-md-5">
                        <label>TEMPAT LAHIR</label>
                        <input type="text" class="form-control" value="{{ $user->tmp_lahir }}" name="tmp_lahir">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>TANGGAL LAHIR</label>
                        <input type="date" class="form-control" value="{{ $user->tgl_lahir }}" name="tgl_lahir">
                    </div>


                    <div class="form-group col-md-5">
                        <label>JENIS KELAMIN</label>
                        <select name="jns_kelamin" value="{{ $user->jns_kelamin }}" class=" form-control form-control-select2" data-container-css-class="border-teal" data-dropdown-css-class="border-teal">
                            <option value="Laki-laki">Laki laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                    </div>
                </div>
                <!-- membuat komponen sidebar yang berisi tombol untuk upload article -->
                <div class="col-md-5 bg-white" style="height:80px" !important>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-md btn-outline-primary col-md-3" value="UPDATE">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection