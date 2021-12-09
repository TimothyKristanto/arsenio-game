<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login', [

        ]);
    }

    public function login(Request $request){
        $dataValidation = $request->validate([
            'email'=>'required|email:dns',
            'password'=>'required'
        ]);

        $check = DB::table('users')->where('email', $request->email)->first();

        if($check != null){
            if($check->is_active == '1'){
                if($check->is_login =='0'){
                    if(Auth::attempt($dataValidation)){
                        User::findOrFail(Auth::id())->update([
                            'is_login'=>'1'
                        ]);

                        $request->session()->regenerate();
                        return redirect()->intended('/home');
                    }
                }else{
                    return back()->with('loginError', 'Akun anda sedang digunakan');
                }
            }else{
                return back()->with('loginError', 'Akun anda telah di non-aktifkan');
            }
        }else{
            return back()->with('loginError', 'Login gagal');
        }

        return back()->with('loginError', 'Login gagal!');
    }
}
