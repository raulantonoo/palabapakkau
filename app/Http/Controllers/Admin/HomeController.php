<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('admin.index');
    // }
    public function user()
    {
        $user = User::all();
        //  dd($user);
        return view('admin.user.user', ['user' => $user]);
    }
    // public function delete($id)
    // {
    //     user::where('id', $id)
    //         ->delete();
    //     return redirect()->action('HomeController@user');
    // }
}
