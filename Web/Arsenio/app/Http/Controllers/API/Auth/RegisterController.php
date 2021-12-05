<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(Request $request){
        if($request->confirmPassword === $request->password){
            $validated = $request->validate([
                'name'=>'required|max:99',
                'email'=>'required|email:dns|unique:users',
                'password'=>'required|min:8'
            ]);
    
            $validated['password'] = bcrypt($validated['password']);
    
            $user = User::create($validated);
            
            if(empty($user)){
                return response([
                    'message'=>'Register gagal'
                ]);
            }else{
                return response([
                    'message'=>'Register berhasil'
                ]);
            }
        }else{
            return response([
                'message'=>'Konfirmasi password salah!'
            ]);
        }

        
    }
}
