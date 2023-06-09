<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    function index(){
        return view('login');
    }
    
    function login(Request $request){
        $keys=[
            'tel'=>$request->tel,
            'password'=>$request->password,
        ];
        if (Auth::attempt($keys)) {
            if(auth()->user()->first_login){
                return redirect()->intended('/pass-change');
            }
            // ログイン成功
            $request->session()->regenerate();
            return redirect()->intended('/news');
        } else {
            // ログイン失敗
            return redirect()->back()->withErrors(['tel' => '電話番号かパスワードか間違います。']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login'); //ログアウト時に転送。
    }
}
