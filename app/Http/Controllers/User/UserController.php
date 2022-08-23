<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Clothes;
use App\User;
use App\Model\Ulasan;
use App\Model\Wishlist;

class UserController extends Controller
{


    public function index(Request $request)
    {
        $user = $request->user();
        $user = user::where('id', $user->id)->first();
        return view('livewire.user_detail', ['user' => $user]);
    }

    public function ubah($id)
    {
        $user = user::where('id', $id)->first();
        return view('livewire.edit_user', ['user' => $user]);
    }
    public function proses(Request $request)
    {
        $id = $request->id;
        $jns_kelamin = $request->jns_kelamin;
        $name = $request->name;
        $email = $request->email;
        $tmp_lahir = $request->tmp_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $no_hp = $request->no_hp;

        User::where('id', $id)
            ->update([
                'jns_kelamin' => $jns_kelamin,
                'name' => $name,
                'email' => $email,
                'no_hp' => $no_hp,
                'tmp_lahir' => $tmp_lahir,
                'tgl_lahir' => $tgl_lahir,
            ]);

        return redirect('/pengguna');
    }
    public function update(Request $request, user $user)
    {

        $input = $request->all();

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['photo'] = "$profileImage";
        } else {
            unset($input['photo']);
        }

        $user->update($input);

        return redirect('/user');
    }

    public function store_fotoprofil(Request $request, User $user)
    {

        $this->validate($request, [
            'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('photo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['photo'] = "$profileImage";
        } else {
            unset($input['photo']);
        }

        $user->update($input);

        return redirect('/user_detail');
    }

    //review
    public function add_process(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'komentar' => 'required',
        ]);
        if (Auth::user()) {
            ulasan::create([
                'nama' => $request->nama,
                'komentar' => $request->komentar,
            ]);
            return redirect('/review');
        } else {
            return abort('403');
        }
    }
}
