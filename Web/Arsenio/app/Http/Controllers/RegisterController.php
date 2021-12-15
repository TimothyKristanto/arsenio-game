<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('register', [
            
        ]);
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
        //
        
        if($request->passwordConfirmation == $request->password){
            $request->validate([
                'name'=>'required|min:4|max:14',
                'email'=>'required|email:dns|unique:users',
                'password'=>'required|min:8'
            ]);
        
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'role'=>'user',
                'is_login'=>'0',
                'is_active'=>'1'
            ]);

            Student::create([
                'story_on_progress'=>1,
                'exp_id'=>1,
                'user_id'=>$user->id,
                'golds'=>0,
                'total_exp'=>0,
                'abyss_point'=>0
            ]);

            // Student::create([
            //     'story_on_progress'=>1,
            //     'exp_id'=>1,
            //     'user_id'=>$user->id,
            //     'golds'=>0,
            //     'total_exp'=>0,
            //     'abyss_point'=>0
            // ]);
    
            return redirect('/');
        }else{
            return back()->with('registerError', 'Konfirmasi password salah!');
        }

        return back()->with('registerError', 'Register gagal!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
