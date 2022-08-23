<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Wishlist;
use App\Model\WishlistDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('status', 'wishlist')->first();
        }
        $data = array(
            'title' => 'Wishlist',
            'itemwish' => $wishlist,

        );
        return view('livewire.wish', $data)->with('no', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
        ]);
        $user = $request->user();

        $product = Product::findOrFail($request->product_id);

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('status', 'wishlist')
            ->first();

        if ($wishlist) {
            $wishlist = $wishlist;
        } else {

            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
            $inputanwish['user_id'] = $user->id;
            $inputanwish['status'] = 'wishlist';
            $wishlist = Wishlist::create($inputanwish);
        }

        $validasiwishlist = WishlistDetail::where('wishlist_id', $wishlist->id)
            ->where('product_id', $product->id)
            ->first();

        if ($validasiwishlist) {
            // $validasiwishlist->delete(); //kalo udah ada, berarti wishlist dihapus
            return back()->with('success', 'Wishlist berhasil dihapus');
        } else {
            $inputan = $request->all();
            $inputan['wishlist_id'] = $wishlist->id;
            $inputan['product_id'] = $product->id;
            $wishlist = WishlistDetail::create($inputan);
            $notification = array(
                'message' => 'Successfully DeActivated',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
            //return back()->with('record_added', 'berhasil di tambah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = WishlistDetail::findOrFail($id);
        // update total cart dulu
        if ($detail->delete()) {
            return back()->with('success', 'asil dihapus');
        } else {
            return back()->with('error', 'Item gagal dihapus');
        }
        // $wishlist = Wishlist::findOrFail($id);
        // if ($wishlist->delete()) {
        //     return back()->with('success', 'Wishlist berhasil dihapus');
        // } else {
        //     return back()->with('error', 'Wishlist gagal dihapus');
        // }
    }
}
