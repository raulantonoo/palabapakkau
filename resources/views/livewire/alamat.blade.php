@extends('layouts_user.app')

@section('content')

<style>
    .a {

        font-weight: bold;
    }

    body {
        background-color: white;
    }
</style>
<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Alamat Pengiriman</li>
            </ol>
        </nav>

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

        <div class="col col-md-11 ml-auto mr-auto mb-2">

            <div class="text-right mr-4  mt-3">

                <button type="submit" data-toggle="modal" data-target="#modal-tabbedd" class="btn btn-outline-success btn-sm mr-3">
                    Tambah alamat <i class="fa-solid fa-plus"></i>
                </button>
                <a href="{{ URL::to('checkout') }}" class="btn btn-sm btn-outline-secondary">
                    Tutup
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div class="a m-2 text-left">
                        Alamat Pengiriman
                    </div>
                    <table class="table table-stripped">

                        <tbody>
                            @forelse($itemalamatpengiriman as $pengiriman)
                            <tr>
                                <td>
                                    {{ ucwords($pengiriman->nama_penerima) }} | {{ $pengiriman->no_tlp }}
                                    <br />
                                    {{ ucwords($pengiriman->alamat) }}<br />
                                    {{ ucwords($pengiriman->kelurahan)}}, Kec. {{ucwords( $pengiriman->kecamatan)}}, Kab. {{ucwords ($pengiriman->city->name)}}, {{ ucwords($pengiriman->province->name)}}
                                    <br />Kode Pos {{ $pengiriman->kodepos}}
                                </td>

                                <td class="text-center">
                                    <form action="{{ route('alamatpengiriman.update',$pengiriman->id) }}" method="post">
                                        @method('patch')
                                        @csrf()
                                        @if($pengiriman->status == 'utama')
                                        <button type="submit" class="btn btn-outline-info btn-sm" disabled>Alamat Utama <i class="fa-solid fa-map-location"></i></button>
                                        @else
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Set Sebagai Alamat Utama <i class="fa-solid fa-location-dot"></i></button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('alamatpengiriman.destroy', $pengiriman->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            Hapus <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                </td>
                            <tr>
                                @empty
                                <td>
                                    OOPSS alamat pengiriman kosong
                                </td>
                            </tr>

                            </tr>

                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-tabbedd" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-md ">
        <div class="modal-content">

            <form action="{{ route('alamatpengiriman.store') }}" method="post">
                @csrf()
                <div class="row-lg-12">
                    <div class="card-header" style="background-color:#e9ecef">
                        Tambah Alamat Baru
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="nama_penerima">Nama Penerima</label>
                            <input required type="text" name="nama_penerima" class="form-control" value={{old('nama_penerima') }}>
                        </div>
                        <div class="form-group">
                            <label for="no_tlp">No Tlp</label>
                            <input required type="text" name="no_tlp" class="form-control" value={{old('no_tlp') }}>
                        </div>

                        <div class="form-group">
                            <label for="title">Provinsi</label>
                            <select name="province_id" class="form-control">
                                <option value=>--- pilih provinsi tujuan ---</option>
                                @foreach ($provinces as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Kabupaten</label>
                            <select name="city_id" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input required type="text" name="kecamatan" class="form-control" value={{old('kecamatan') }}>
                        </div>
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input required type="text" name="kelurahan" class="form-control" value={{old('kelurahan') }}>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Nama Jalan, Gedung, No.Rumah</label>
                            <input required type="text" name="alamat" class="form-control" value={{old('alamat') }}>
                        </div>
                        <div class="form-group">
                            <label for="kodepos">Kodepos</label>
                            <input required type="text" name="kodepos" class="form-control" value={{old('kodepos') }}>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn  btn-sm btn-outline-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="province_id"]').on('change', function() {
            var provinceID = $(this).val();
            if (provinceID) {
                $.ajax({
                    url: '/alamatpengiriman/ajax/' + provinceID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {


                        $('select[name="city_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });


                    }
                });
            } else {
                $('select[name="city_id"]').empty();
            }
        });
    });
</script>

@endsection