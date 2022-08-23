<style>
    .article:nth-child(odd) {
        margin-bottom: 1%;
        margin-top: 2%;
    }

    .article:nth-child(even) {
        margin-left: 37%;
    }
</style>
<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Produk Tshirt</li>
            </ol>
        </nav>

        <div class="row m-0">
            <div class="col-md-7">
                @foreach( $ulasan as $u)
                <div class="card col-md-5 p-0 text-center article">
                    <div style="background-color:azure; font-weight:bold">
                        <h6 style="font-weight:bold" class="mt-3"> {{$u->nama}}</h6>

                    </div>
                    <br>
                    <p>
                        {{$u->komentar}}
                    </p>
                </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="mt-3">
                    Tambahkan Komentar
                </div>

                <div>
                    <form method="post" action="/add_process" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama anda">
                        </div>
                        <div class="form-group">
                            <label>Komentar</label>
                            <textarea class="form-control " rows="4" name="komentar" placeholder="Berikan komentar anda"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary col-sm-12" value="Kirim">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@include('livewire.footer')
<!-- membuat komponen sidebar yang berisi tombol untuk upload artikel -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>