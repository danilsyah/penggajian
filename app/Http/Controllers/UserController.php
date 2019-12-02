<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Session;

class UserController extends Controller
{
    protected function index()
    {
        $user_list = User::all();
        return view('user.index', compact('user_list'));
    }

    protected function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('user')->with('message', 'Data Berhasil Di Hapus Dengan id : ' . $id);
    }
}
