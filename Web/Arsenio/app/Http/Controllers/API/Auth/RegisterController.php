<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\ItemStudentRelation;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register(Request $request){
        if($request->confirmPassword == $request->password){
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
                $student = Student::create([
                    'exp_id'=>1,
                    'user_id'=>$user->id,
                    'golds'=>0,
                    'total_exp'=>0,
                    'abyss_point'=>0,
                    'story_level_progress'=>11
                ]);
    
                for($i = 1; $i <= 3; $i++){
                    ItemStudentRelation::create([
                        'item_id'=>$i,
                        'student_id'=>$student->student_id,
                        'item_owned'=>0
                    ]);
                }

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
