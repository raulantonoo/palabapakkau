<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Cek Biaya Pengiriman</li>
            </ol>
        </nav>
        <div class="row m-0">
            <div class="col-md-4">
                <div class="card ml-3 mb-4 mt-3">
                    <div class="card-body">
                        <h3 class="text-center">TUJUAN PENGIRIMAN</h3>
                        <hr>
                        <div class="form-group">
                            @if($alamat)
                            <tr>
                                <td colspan="2">
                                    <b> {{ucwords($alamat->nama_penerima) }} </b>| {{ $alamat->no_tlp }}
                                    <br />
                                    {{ ucwords($alamat->alamat) }}<br />
                                    {{ ucwords($alamat->kelurahan)}}, Kec. {{ ucwords($alamat->kecamatan)}}, {{ ucwords($alamat->city->name)}}, {{ ucwords($alamat->province->name)}}
                                    <br>
                                    Kode pos {{ $alamat->kodepos}}
                                </td>
                            </tr>
                            <br>

                            <tr>
                                <td>
                                    <a href="/alamatpengiriman" class="btn btn-warning btn-sm mt-2 mb-3">
                                        Ubah Alamat
                                    </a>
                                </td>
                                @else
                                <td>
                                    <a href="/alamatpengiriman" class="btn btn-warning btn-sm">
                                        Tambah Alamat
                                    </a>
                                </td>
                            </tr>
                            @endif
                            <form wire:submit.prevent="getOngkir">
                                <label for="jasa" class="font-weight-bold">Jasa pengiriman</label>
                                <select class="form-control" name="jasa" wire:model="jasa">
                                    <option value="">-- pilih jasa pengiriman --</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">Pos Indonesia</option>
                                    <option value="tiki">Tiki</option>
                                </select>

                                <div class="col mt-4 p-0">
                                    <button type="submit" class="btn btn-sm btn-outline-primary ">CEK ONGKOS KIRIM</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if($result)
                <div class="row">
                    <div class="card mt-3">
                        <div class="mr-auto ml-auto mt-3 ">
                            <b>{{$nama_jasa}} </b>
                        </div>

                        <div class="card-body text-center">

                            <table class="table table-stripped table-responsive">
                                <thead>
                                    <th>Ongkos Kirim</th>
                                    <th>Lama Pengiriman</th>
                                    <th>Jenis Pengiriman</th>
                                    <th colspan="2">Opsi</th>
                                </thead>
                                <tbody>
                                    @forelse($result as $r)
                                    <tr class="text-center">
                                        <td>
                                            Rp {{number_format($r['biaya'])}}
                                        </td>
                                        <td>{{$r['etd']}} Hari</td>
                                        <td>{{$r['service']}} ({{$r['description']}})</td>
                                        <td class="text-center"><button class=" btn btn-sm btn-outline-info" wire:click="save_ongkir({{$r['biaya']}})">
                                                Tambah sebagai ongkir
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>

    </div>
</div>
</div>
</div>