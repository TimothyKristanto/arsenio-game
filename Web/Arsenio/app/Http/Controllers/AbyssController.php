<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbyssController extends Controller
{
    public function index(){
        return view('abyss', [
            'page'=>'ABYSS'
        ]);
    }
}
