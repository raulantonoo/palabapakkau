<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Model\CartDetail;
use App\Model\Cart;
use App\User;
use App\Model\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\Wishlist;
use App\Model\WishlistDetail;

class ProdukController extends Controller
{


    public function search(Request $request)
    {
        $cari = $request->cari;
        $product = DB::table('products')
            ->where('nama', 'like', "%" . $cari . "%")
            ->paginate(12);
        return view('livewire.product-all', ['products' => $product]);
    }

    public function detail(Request $request, $id)
    {

        $product = Product::where('id', $id)->first();

        $data = array(
            'product' => $product,
        );

        return view('livewire.product-detail', $data);
    }
}
