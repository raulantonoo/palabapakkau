<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CartDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Model\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = product::get();
        $category = category::all();
        $detail = CartDetail::get();
        return view('admin.product.product', ['product' => $product, 'category' => $category, 'detail' => $detail]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            // 'id_kategori' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'harga_beli' => 'required',
            'ukuran' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        // menyimpan data file yang diupload ke variabel $file
        $product = $request->file('gambar');

        $nama_file = time() . "_" . $product->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images';
        $product->move($tujuan_upload, $nama_file);

        Product::create([
            'gambar' => $nama_file,
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'ukuran' => $request->ukuran,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'category_id' => $request->category_id,
        ]);


        return redirect('/produk');
    }

    public function edit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        return response()->json([
            'status' => 200,
            'product' => $product,
            'category' => $category,
        ]);
    }

    public function update(Request $request)
    {

        DB::table('products')->where('id', $request->id)->update([
            'id' => $request->id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'ukuran' => $request->ukuran,
            'harga_beli' => $request->harga_beli,
            'harga' => $request->harga,
            'promo' => $request->promo,
            'category_id' => $request->category_id,

        ]);

        return redirect('/produk');
    }

    public function promo($id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => 200,
            'product' => $product,
        ]);
    }

    public function updatepromo(Request $request)
    {
        DB::table('products')->where('id', $request->id)->update([
            'id' => $request->id,
            'promo' => $request->promo,
        ]);
        //dd($request->promo);
        return redirect('/produk');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('delete_id');
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus');
    }
}
