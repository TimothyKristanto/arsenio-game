<?php

namespace App\Http\Controllers;

use App\Models\GameLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    //

    function index(){
        $user = User::where('id', Auth::user()->id)->first();

        return view('admin', [
            'page'=>'ADMIN',
            'user'=>$user
        ]);
    }

    function showGameLogs(){
        $gameLogs = GameLog::all();
        $user = User::where('id', Auth::user()->id)->first();

        return view('gameLogs', [
            'page'=>'ADMIN: See game logs',
            'gameLogs'=>$gameLogs,
            'user'=>$user
        ]);
    }

    function banUser($id){
        User::where('id', $id)->update([
            'is_active'=>'0'
        ]);

        return redirect('/admin');
    }
}
