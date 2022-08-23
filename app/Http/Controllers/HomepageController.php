<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Clothes;
use App\Model\Wishlist;
use app\Ongkos;

class HomepageController extends Controller
{
    public function index(Request $request)
    {

        $clothes = clothes::inRandomOrder()->take(8)->get();
        return view('user.index', ['clothes' => $clothes]);
    }
    public function data()
    {

        return view('user.data');
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            // 'id_kategori' => 'required',
            'etd' => 'required',
            'biaya' => 'required',
            'service' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file

        Ongkos::create([
            'etd' => $request->etd,
            'biaya' => $request->biaya,
            'service' => $request->service,
        ]);


        // dd($clothes);
        // dd($clothes);
        return redirect('/produk');
    }
}
