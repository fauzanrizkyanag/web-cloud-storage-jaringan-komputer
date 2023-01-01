<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        if (Auth::check()) 
        {
            return redirect('home');
        }
        else
        {
            return view('register/index');
        }
    }

    public function prosesRegister(Request $request){
        $this->validate($request, [
            'username' => 'required|unique:users,name',
            'email' => 'required|email:dns|unique:users,email',
            'password1' => 'required',
            'password2' => 'required|same:password1'
        ]);

        User::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password1'))
        ]);

        Session::flash('status', 'Registrasi berhasil');
        return redirect('/');
    }
}
