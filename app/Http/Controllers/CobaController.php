<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cobaa;
use App\Http\Livewire\Coba;

class CobaController extends Controller
{
    public function index()
    {
        $users = cobaa::get();
        return view('cobaan', compact('users'));
    }


    public function changeStatus(Request $request)
    {
        $user = cobaa::find($request->cobaa_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
