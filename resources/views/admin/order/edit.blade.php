<style>
    h1 {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<h1>EDIT order</h1>
<!-- membuat komponen main yang berisi form untuk mengisi judul dan isi artikel -->
<div class="col-sm-12 bg-white p-4">

    <form method="post" action="/transaksi/edit_process">
        @csrf
        <input type="hidden" value="{{ $order->id }}" name="id">
        <div class="form-group">
            <label>TITLE</label>
            <input type="text" class="form-control" value="{{ $order->status_cart}}" name="status_cart" placeholder="Judul order">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-primary col-md-3" value="UPDATE">
        </div>
    </form>
</div>