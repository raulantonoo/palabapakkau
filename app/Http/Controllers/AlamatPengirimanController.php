<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Alamat;
use App\Model\AlamatPengiriman;
use Illuminate\Http\Request;
use App\Model\Province;
use App\Model\City;
use Illuminate\Support\Facades\DB;

class AlamatPengirimanController extends Controller
{
    public function index(Request $request)
    {
        $provinces = DB::table("provinces")->pluck("name", "id");

        $itemuser = $request->user();
        $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)->paginate(10)
            ->sortByDesc('created_at');

        return view('livewire.alamat', compact('itemalamatpengiriman', 'provinces'))->with('no', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function alamatpengirimanAjax($id)
    {
        $cities = DB::table("cities")
            ->where("province_id", $id)
            ->pluck("name", "city_id");
        return json_encode($cities);
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
        //dd($request);
        $this->validate($request, [
            'nama_penerima' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'city_id' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kodepos' => 'required',
        ]);

        $itemuser = $request->user(); //ambil data user yang sedang login

        //buat variabel dengan nama $inputan


        $itemalamatpengiriman = AlamatPengiriman::create([

            'user_id' => $itemuser->id,
            'status' => 'utama',
            'nama_penerima' => $request->nama_penerima,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'kodepos' => $request->kodepos,
        ]);
        // set semua status alamat pengiriman bukan utama
        AlamatPengiriman::where('id', '!=', $itemalamatpengiriman->id)
            ->update(['status' => 'tidak']);
        return back()->with('success', 'Alamat pengiriman berhasil disimpan');
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
        $itemalamatpengiriman = AlamatPengiriman::findOrFail($id);
        $itemalamatpengiriman->update(['status' => 'utama']);
        AlamatPengiriman::where('id', '!=', $id)->update(['status' => 'tidak']);
        return back()->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemalamatpengiriman = AlamatPengiriman::findOrFail($id);
        // update total cart dulu

        if ($itemalamatpengiriman->delete()) {
            return back()->with('success', 'Alamat berhasil dihapus');
        } else {
            return back()->with('error', 'Alamat gagal dihapus');
        }
    }
}
