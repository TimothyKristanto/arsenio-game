<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request){
        
        $user = [
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'user',
            'is_login'=>'0',
            'is_active'=>'1'
        ];

        $check = DB::table('users')->where('email', $request->email)->first();

        if(!empty($check)){
            if ($check->is_active == '1') {
                if (Auth::attempt($user)) {
                    $user = User::findOrFail(Auth::id());

                    $response = Http::asForm()->post('https://playarsenio.000webhostapp.com/oauth/token', [
                        'grant_type' => 'password',
                        'client_id' => $this->client->id,
                        'client_secret' => $this->client->secret,
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*',
                    ]);

                    return $response->json();
                } else {
                    return response([
                        'message' => 'Login gagal' 
                    ]);
                }
            } else {
                return response([
                    'message' => 'Akun telah di ban'
                ]);
            }
        }else{
            return response([
                'message'=>'Email atau password salah'
            ]);
        }
        
    }

    public function refresh(Request $request){
        $this->validate($request, [
            'refresh_token'=>'required',
        ], [
            'refresh_token'=>'refresh token diperlukan',
        ]);

        $response = Http::asForm()->post('https://playarsenio.000webhostapp.com/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => '*',
        ]);
        
        return $response->json();
    }

    public function logout(){
        /** @var \App\Models\User\ $user */

        $user = Auth::user();
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id);

        $user->update([
            'is_login'=>'0',
        ]);

        $accessToken->revoke();

        return response([
            'message'=>'Log out berhasil',
        ]);
    }
}
