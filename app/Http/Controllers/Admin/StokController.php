<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CartDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Model\Category;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    public function index()
    {
        $product = product::get();
        $category = category::all();

        return view('admin.stock.stock', ['product' => $product, 'category' => $category]);
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
            'stok' => $request->stok,
            'terjual' => $request->terjual,
        ]);

        return redirect('/stok_barang');
    }
}
